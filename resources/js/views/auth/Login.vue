<template>
    <h1>Login page</h1>
    <div class="container mt-10 mb-10">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <sb-form title="Login" :fields="fields" url="/login" callBack="setActiveUser">
                    <template v-slot:footer>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Login</button>
                        </div>
                        <p class="mb-0 text-right">Forgot your password ?
                            <router-link :to="{name: 'auth.forgetPassword'}">Click Here</router-link>
                            to reset it
                        </p>
                    </template>
                </sb-form>
            </div>
        </div>
    </div>
</template>

<script>

// import axios from "../../services/apiService";

export default {
    name: "Login",
    data() {
        return {
            fields: {
                email: {
                    label: "Email",
                    placeholder: "Enter Email Address",
                    required: true,
                },
                password: {
                    label: "Password",
                    type: 'password',
                    required: true,
                }
            },
            login: {
                email: '',
                password: ''
            }
        }
    },
    methods: {
        async setActiveUser(data) {
            // await this.$store.commit('SET_AUTH_TOKEN', data)
            // await axios.get('/user').then(response => {
            //     this.$store.commit('SET_USER', response.data)
            //     this.$router.push('/dashboard')
            //     console.log(this.$store.state)
            // })
            // console.log(this.$store.state)
        }

    },
    mounted() {
        // console.log(this.$store.state)
    }
}
</script>

<style scoped>

</style>
