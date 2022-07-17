<template>
    <sb-header title="Create Role" description="Create Role"/>
    <div class="container-xl px-4 mt-n10">
        <form @submit.prevent="saveRole" class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Role</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Role Name</label>
                            <input type="text" v-model="role.name" class="form-control" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <MultiSelectField :field-info="fieldInfo" v-model="role.permissions"
                                              :axios="axios"></MultiSelectField>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Menu Builder
                        <button type="button" @click="createGroup" class="float-end btn btn-sm btn-primary">Create Menu
                            Group
                        </button>
                    </div>
                    <div class="card-body">

                        <Tree :value="myMenu">
                            <template v-slot="{node, index, path, tree}">
                                <i :class="node.icon"></i> {{ node.label }}
                                <span class="float-end" @click="editMenuTitle(node)"><i class="fas fa-edit"></i></span>
                            </template>
                        </Tree>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
import axios from '@/services/apiService'
import {MultiSelectField} from "sb-form";
import 'he-tree-vue/dist/he-tree-vue.css'
import {Tree, Draggable} from 'he-tree-vue'
import toastr from "toastr";

export default {
    name: "CreateRole",
    components: {
        MultiSelectField: MultiSelectField,
        Tree: Tree.mixPlugins([Draggable])
    },
    computed: {
        myMenu() {
            let core = [
                {
                    'group': true,
                    'label': 'core',
                    'children': this.role.permissions.filter(value => value.sidebar_menu == 1)
                }
            ]
            return [...core, ...this.menu_groups]
        }
    },
    data() {
        return {
            axios: axios,
            fieldInfo: {
                label: 'Permissions',
                config: {
                    value: (value) => value.name,
                    display: (value) => `${value.name} | ${value.description}`,
                },
                ajax: '/permissions'
            },
            permissions: [],
            role: {
                name: '',
                permissions: [],
                menus: [],
            },
            menu_groups: []
        }
    },
    methods: {
        saveRole() {
            this.role.side_nav = JSON.stringify(this.myMenu)
            axios.post('/create-role', this.role).then(response => {
                console.log(response.data)
                toastr.success(response.status, response.data.message)
                this.role.name = ''
                this.role.permissions = []
            }).catch(error => {
                if (error.response.status == 422) {
                    for (let err in error.response.data.errors) {
                        toastr.error(err, error.response.data.errors[err])
                    }
                } else {
                    toastr.error(error.response.status, error.response.statusText)
                }

                // console.log(error.response)
                // console.log(error.response.data.errors)
            })
        },
        createGroup() {
            let name = prompt('Enter a group name')
            this.menu_groups.push({
                'group': true,
                'label': name,
                'children': []
            })
        },

        editMenuTitle(node) {
            let label = prompt("Change name", node.label)
            node.label = label
        }
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
