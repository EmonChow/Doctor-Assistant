<template>
    <sb-form :axios="axios" :fields="fields" title="Reset Password" url="/forget-password">

    </sb-form>

</template>

<script>
import apiService from "../../services/apiService";

export default {
    name: "ForgetPassword",
    data: () => ({
        axios: apiService,
        fields: {
            email: {
                label: 'Enter your email address',
            }
        }
    })
}
</script>

<style scoped>

</style>
