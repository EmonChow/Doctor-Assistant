<template>
    <sb-form :fields="fields" url="/registration" :axios="axios">

    </sb-form>
</template>

<script>
import apiService from "../../services/apiService";

export default {
    name: "Registration",
    data: () => ({
        axios: apiService,
        fields: {
            email: {
                label: 'Email'
            }
        }
    }),
    methods: {}
}
</script>

<style scoped>

</style>
