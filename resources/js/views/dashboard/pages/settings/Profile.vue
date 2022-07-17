<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <TabNav></TabNav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                <sb-form :fields="fields" url="/profile" :resetForm="false" :axios="axios"/>
            </div>
        </div>
    </div>
</template>

<script>
import apiService from "../../../../services/apiService";
import TabNav from "./TabNav";

export default {
    name: "Profile",
    components: {
        TabNav
    },
    data() {
        return {
            axios: apiService,
            fields: {
                photo: {
                    label: 'Profile Photo',
                    type: 'file_field',
                    value: this.$store.state.user.photo
                },
                name: {
                    label: 'Full Name',
                    value: this.$store.state.user.name
                },
                phone: {
                    label: 'Phone',
                    value: this.$store.state.user.phone
                },
                address: {
                    label: 'Address',
                    type: 'text_field',
                    value: this.$store.state.user.address
                }
            }
        }
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
