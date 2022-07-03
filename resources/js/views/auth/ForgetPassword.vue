<template>
    <div class="card">
        <div class="card-header">
            Forget my password
        </div>
        <div class="card-body">
            as
        </div>
        <div class="card-footer">
            Back to
            <router-link :to="{name: 'login'}">Login</router-link>
        </div>
    </div>
</template>

<script>
export default {
    name: "ForgetPassword"
}
</script>

<style scoped>

</style>
