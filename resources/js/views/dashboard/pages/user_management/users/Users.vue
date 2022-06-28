<template>
    <sb-header type="overlap" title="Users" description="User list"></sb-header>
    <div class="container-xl px-4 mt-n10">
        <data-table url="/users" :columns="columns">
            <template v-slot:tableHeader>
                <div class="row justify-content-between">
                    <div class="col">Users</div>
                    <div class="col">
                        <router-link to="/create-user" class="btn btn-primary btn-sm float-end">+ Create User
                        </router-link>
                    </div>
                </div>
            </template>

            <template v-slot:actions="{item}">
                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                    <router-link :to="{name: 'edit-user', params: {id: item.id}}" class="btn btn-primary">Edit
                    </router-link>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </template>
        </data-table>
    </div>
</template>

<script>
import DateTable from '../../../../../components/data-table/DataTable'

export default {
    name: "Users",
    components: {
        'data-table': DateTable
    },
    data() {
        return {
            columns: [
                {label: 'First Name', field: 'first_name', searchable: true},
                {label: 'Last Name', field: 'last_name', searchable: true},
                {label: 'Email', field: 'email', searchable: true},
                {label: 'Actions', field: 'actions'}
            ]
        }
    }
}
</script>

<style scoped>

</style>
