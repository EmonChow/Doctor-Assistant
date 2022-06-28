<template>
  <Navbar></Navbar>
  <div id="layoutSidenav">
    <Sidebar></Sidebar>
    <div id="layoutSidenav_content">
      <main>

        <!-- Main page content-->
        <router-view/>
      </main>

      <Footer></Footer>
    </div>
  </div>
</template>

<script>
import Navbar from "./inc/NavBar.vue";
import Footer from "./inc/Footer.vue";
import Sidebar from "./inc/Sidebar.vue";
export default {
  components: {
    Navbar,
    Footer,
    Sidebar
  },
};
</script>