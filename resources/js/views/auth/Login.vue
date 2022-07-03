<template>
    <sb-form title="Login" url="/login" :fields="fields" :axios="axios">

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
    })
}
</script>

<style scoped>

</style>
