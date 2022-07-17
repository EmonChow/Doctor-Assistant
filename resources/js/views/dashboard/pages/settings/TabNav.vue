<template>
    <nav class="nav nav-borders">
        <router-link :to="{name:'profile'}" class="nav-link ms-0">Profile</router-link>
        <router-link :to="{name:'changeEmail'}" class="nav-link ms-0">Change Email</router-link>
        <router-link :to="{name:'changePassword'}" class="nav-link ms-0">Change Password</router-link>
        <router-link :to="{name:'security'}" class="nav-link ms-0">Security</router-link>
    </nav>
</template>

<script>
export default {
    name: "TabNav"
}
</script>

<style scoped>

</style>
