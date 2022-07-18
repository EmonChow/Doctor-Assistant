<template>
    <sb-form title="Login" url="/login" :fields="fields" :axios="axios" call-back="setActiveUser">
        <template v-slot:header>
            <h3 class="mb-0">Login</h3>
        </template>

        <template v-slot:fields-after>
            <router-link class="text-end" :to="{name: 'auth.forgetPassword'}">Forgot Passwoord ?</router-link>
        </template>
        <template v-slot:footer>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary float-end">Login</button>
            </div>

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
