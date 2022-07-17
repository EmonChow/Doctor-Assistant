<template>
    <sb-header type="compact" :links="links" title="Profile"></sb-header>
    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <TabNav></TabNav>
        <hr class="mt-0 mb-4">
        <div class="row justify-content-center">

            <div class="col-xl-6">
                <!-- Account details card-->
                Login history
            </div>
        </div>
    </div>
</template>

<script>
import TabNav from "./TabNav";

export default {
    name: "Security",
    components: {
        TabNav
    },
}
</script>

<style scoped>

</style>
