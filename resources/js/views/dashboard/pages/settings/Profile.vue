<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <router-link :to="{name:'profile'}" class="nav-link active ms-0">Profile</router-link>
            <router-link :to="{name:'changeEmail'}" class="nav-link ms-0">Change Email</router-link>
            <router-link :to="{name:'changePassword'}" class="nav-link ms-0">Change Password</router-link>
        </nav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                <sb-form :fields="fields" url="/profile" :resetForm="false"/>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Profile",
    data() {
        return {
            fields: {
                photo: {
                    label: 'Profile Photo',
                    type: 'file_field',
                    value: this.$store.state.user.photo
                },
                first_name: {
                    label: 'First Name',
                    value: this.$store.state.user.first_name
                },
                last_name: {
                    label: 'Last Name',
                    value: this.$store.state.user.last_name
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
