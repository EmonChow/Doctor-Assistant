<template>
    <div class="d-flex align-items-center justify-content-center vh-100">
        <div class="col-md-4">
            <div class="mb-4">
                <router-link to="/">
                    <img height="100" src="http://dap-demo.bcmedico.com/web/icons/icon.png" alt="">
                </router-link>
            </div>
            <router-view/>
        </div>
    </div>

</template>

<script>
export default {
    name: "Layout"
}
</script>

<style scoped>

</style>
