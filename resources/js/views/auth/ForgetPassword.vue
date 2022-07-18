<template>
    <sb-form :axios="axios" :fields="fields" title="Reset Password" url="/forget-password">

        <template v-slot:fields-after>
            <router-link class="text-end" :to="{name:'auth.login'}">Back to login</router-link>
        </template>

        <template v-slot:footer>
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary float-end">Send Reset Link</button>
            </div>
        </template>
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
