<template>
    <sb-header type="overlap" title="Roles" description="Roles"/>
    <div class="container-xl px-4 mt-n10">
        <data-table url="/roles" :columns="columns">
            <template v-slot:tableHeader>
                <div class="row justify-content-between">
                    <div class="col">Role</div>
                    <div class="col">
                        <router-link to="/create-role" class="btn btn-primary btn-sm float-end">+ Create Role
                        </router-link>
                    </div>
                </div>
            </template>

            <template v-slot:actions="{item}">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <router-link class="btn btn-primary" :to="{name: 'editRole', params: {id: item.id}}"><i
                        class="far fa-edit"></i> Edit
                    </router-link>
                    <button type="button" class="btn btn-danger" @click="deleteRole(item)"><i
                        class="far fa-trash-alt"></i>
                        delete
                    </button>
                </div>
            </template>

        </data-table>
    </div>

</template>

<script>

import axios from "../../../../../services/apiService";

export default {
    name: "Roles",
    data() {
        return {
            columns: [
                {label: 'Name', field: 'name', searchable: true},
                {label: 'Guard Name', field: 'guard_name', searchable: true},
                {label: 'Actions', field: 'actions'}
            ]
        }
    },
    methods: {
        deleteRole(item) {
            axios.delete(`/role/${item.id}`).then(response => {
                console.log(response.data)
            }).catch(error => {
                console.log(error.response)
            })
        }
    }
}
</script>

<style scoped>

</style>
