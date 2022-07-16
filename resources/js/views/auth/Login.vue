<template>
    <sb-form title="Login" url="/login" :fields="fields" :axios="axios" call-back="setActiveUser">
        <template v-slot:footer>
            <button type="submit" class="btn btn-primary float-end">Login</button>
            <p>Forget your password ?
                <router-link :to="{name:'auth.forgetPassword'}">Reset Password</router-link>
            </p>
        </template>
    </sb-form>

</template>

<script>


import apiService from "../../services/apiService";

export default {
    name: "Login",
    data: () => ({
        axios: apiService,
        fields: {
            email: {
                label: 'Email'
            },
            password: {
                label: 'Password',
                type: 'password'
            }
        }
    }),
    methods: {
        async setActiveUser(data) {
            await this.$store.commit('SET_AUTH_TOKEN', data)
            await apiService.get('/get-current-user').then(response => {
                this.$store.commit('SET_USER', response.data)
                this.$router.push('/dashboard')
            })
        }
    }
}
</script>

<style scoped>

</style>
