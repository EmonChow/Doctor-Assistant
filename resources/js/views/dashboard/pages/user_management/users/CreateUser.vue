<template>
    <sb-header type="overlap" :title="formTitle"
               description="Create User who can operate everything from the sidebar according to the role"/>
    <div class="container-xl px-4 mt-n10">
        <sb-form :title="formTitle" :fields="fields"
                 :method="method"
                 :url="url" :resetForm="reset"
                 callBack="saveCountryRegion"
                 :ajax="ajax">

            <template v-slot:additionalFields>
                <UserCountryRegion ref="userCountryRegion" :user_id="$route.params.id"></UserCountryRegion>
            </template>

        </sb-form>
    </div>
</template>

<script>
import axios from "../../../../../services/apiService";
import UserCountryRegion from "../../../../../components/UserCountryRegion";

export default {
    name: "CreateUser",
    components: {
        UserCountryRegion
    },
    computed: {
        title() {

        }
    },
    data() {
        return {
            fields: {
                school_id: {
                    label: 'Select School',
                    col: 12,
                    type: 'select_field',
                    config: {
                        value: 'id',
                        display: 'name',
                        help: 'By Selecting School, this particular user will only able to see data of the selected schools'
                    },
                    ajax: '/school'
                },
                image: {
                    label: 'User Image',
                    type: 'file_field',
                },
                first_name: {
                    label: "First Name",
                    placeholder: "Enter First Name",
                    col: 4,
                    required: true,
                },
                last_name: {
                    label: "Last Name",
                    placeholder: "Enter Last Name",
                    col: 4,
                    required: true,
                },
                email: {
                    label: "Email",
                    placeholder: "Enter Email Address",
                    col: 4,
                    required: true,
                },
                password: {
                    label: "Password",
                    col: 6,
                    type: 'password',
                    required: true,
                },
                re_type_password: {
                    label: "Re Type Password",
                    col: 6,
                    type: 'password',
                    required: true,
                },
                address: {
                    label: "Address",
                    col: 12,
                    type: 'text_field'
                },
                role: {
                    label: 'Role',
                    type: 'select_field',
                    value: 1,
                    options: [
                        {id: 1, name: 'Super Admin'},
                        {id: 2, name: 'Role Two'},
                    ],
                    config: {
                        value: 'id',
                        display: 'name',
                        multiple: true
                    },
                    ajax: '/roles'
                },
            },
            formTitle: 'Create User',
            url: '/create-user',
            method: 'post',
            reset: true,
            ajax: null
        }
    },
    methods: {
        saveCountryRegion(response) {
            this.$refs.userCountryRegion.saveUserCountryRegion(response.user_id)
        }
    },
    beforeMount() {
        if (this.$route.params.id) {
            this.ajax = `user/${this.$route.params.id}`
        }
    },
    async mounted() {
        if (this.$route.params.id) {
            this.formTitle = 'Edit User'
            this.url = `/update-user/${this.$route.params.id}`
            this.method = 'put'
            this.reset = false
        }
    }
}
</script>

<style scoped>

</style>
