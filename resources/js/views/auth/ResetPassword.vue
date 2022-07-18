<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <sb-form v-if="loaded" :axios="axios" :fields="fields" title="Reset Password"
                         call-back="redToLogin"
                         url="/reset-password"></sb-form>
            </div>

        </div>
    </div>
</template>

<script>
import apiService from "../../services/apiService";

export default {
    name: "ResetPassword",
    data: () => ({
        loaded: false,
        token: null,
        axios: apiService,
        fields: {
            email: {label: 'Email'},
            password: {label: 'Password', type: 'password'},
            password_confirmation: {label: 'Re-Type Password', type: 'password'}
        }

    }),
    methods: {
        redToLogin() {
            this.$router.push({name: 'auth.login'})
        }
    },
    mounted() {
        if (this.$route.params.token) {
            this.loaded = true

            this.fields['token'] = {
                label: 'Token',
                value: this.$route.params.token,
                type: 'hidden'
            }

            this.fields['email'] = {
                label: 'Email',
                value: this.$route.query.email
            }
        }

        console.log(this.fields)
    }
}
</script>

<style scoped>

</style>
