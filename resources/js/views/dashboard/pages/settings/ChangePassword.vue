<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <router-link :to="{name:'profile'}" class="nav-link ms-0">Profile</router-link>
            <router-link :to="{name:'changeEmail'}" class="nav-link  ms-0">Change Email</router-link>
            <router-link :to="{name:'changePassword'}" class="nav-link active ms-0">Change Password</router-link>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                <sb-form :fields="fields" url="/change-password" :axios="axios"/>
            </div>
        </div>
    </div>
</template>

<script>
import apiService from "../../../../services/apiService";

export default {
    name: "ChangePassword",
    data() {
        return {
            axios: apiService,
            fields: {
                password: {
                    label: 'New Password',
                    type: 'password'
                },
                password_confirmation: {
                    label: 'Re Type New Password',
                    type: 'password'
                },
                current_password: {
                    label: 'Current Password',
                    type: 'password'
                }
            }
        }
    }
}
</script>

<style scoped>

</style>
