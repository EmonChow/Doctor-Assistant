<template>

    <Navbar/>
    <router-view/>

    <Footer/>

</template>

<script>
import Footer from "./inc/Footer";
import Navbar from "./inc/Navbar";

export default {
    data() {
        return {}
    },
    components: {
        Footer, Navbar
    },
    mounted() {
        // this.$store.dispatch('fetchWebsiteData');
    }
}
</script>
