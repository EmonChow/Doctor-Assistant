<template>
<!--    <sb-form :fields="fields" url="/registration">-->

<!--    </sb-form>-->
</template>

<script>
// import apiService from "../../services/apiService";

export default {
    name: "Registration",
    data() {
        return {
            fields: {
                name: {
                    label: 'Full Name'
                }
            }
        }
    },
    methods: {
        // axios: () => apiService()
    }
}
</script>

<style scoped>

</style>
