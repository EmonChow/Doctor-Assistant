<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <TabNav></TabNav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                <sb-table ref="dataTable" url="/auth-history" title="Login History" :columns="columns" :axios="axios">
                    <template v-slot:action="{item}">
                        <button @click="$refs.dataTable.deleteRow(item, 'Are you sure')" class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </template>
                </sb-table>
            </div>
        </div>
    </div>
</template>

<script>
import TabNav from "./TabNav";
import apiService from "../../../../services/apiService";

export default {
    name: "Security",
    components: {
        TabNav
    },
    data: () => ({
        axios: apiService,
        columns: [
            {label: 'Use', field: 'name'},
            {label: 'Last use', field: 'last_used_at'},
            {label: 'Action', field: 'action'},
        ]
    }),
    methods: {}
}
</script>

<style scoped>

</style>
