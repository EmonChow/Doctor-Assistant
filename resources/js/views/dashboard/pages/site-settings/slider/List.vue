<template>
    <sb-header type="overlap" title="Sliders" description="Slider List"></sb-header>
    <div class="container-xl px-4 mt-n10">
        <data-table ref="dataTable" url="/slider" :columns="columns">
            <template v-slot:tableHeader>
                <div class="row justify-content-between">
                    <div class="col">Sliders</div>
                    <div class="col">
                        <router-link :to="{name: 'createSlider'}" class="btn btn-primary btn-sm float-end">
                            + Create Slider
                        </router-link>
                    </div>
                </div>
            </template>

            <template v-slot:image="{item}">
                <img :src="item.image" class="img-fluid" width="250" alt="">
            </template>

            <template v-slot:actions="{item}">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <router-link :to="{name: 'editSlider', params: {id: item.id}}" class="btn btn-primary">
                        Edit
                    </router-link>
                    <button
                        @click="$refs.dataTable.deleteRow(item)"
                        class="btn btn-danger">
                        Delete
                    </button>
                </div>
            </template>
        </data-table>
    </div>
</template>

<script>
import DateTable from "../../../../../components/data-table/DataTable";

export default {
    name: "List",
    components: {
        'data-table': DateTable
    },
    data() {
        return {
            columns: [
                {label: 'Image', field: 'image'},
                {label: 'Title', field: 'title', searchable: true},
                {label: 'Description', field: 'description', searchable: true},
                {label: 'Actions', field: 'actions'}
            ]
        }
    },
}
</script>

<style scoped>

</style>
