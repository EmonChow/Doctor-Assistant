<template>
    <!-- Sidenav Menu Heading (Core)-->
    <section v-for="(mainMenu, mainMenuIndex) in main_menus">
        <div class="sidenav-menu-heading">{{ mainMenu.label }}</div>
        <section v-for="(menu, index) in mainMenu.children">
            <template v-if="menu.children">
                <a class="nav-link collapsed" href="javascript:void(0);" data-bs-toggle="collapse"
                   :data-bs-target="'#menu'+menu.label.replace(/\s+/g,'_')" aria-expanded="false"
                   aria-controls="collapseUtilities">
                    <div class="nav-link-icon">
                        <i class="fas fa-bars"></i>
                    </div>
                    {{ menu.label }}
                    <div class="sidenav-collapse-arrow">
                        <i class="fas fa-angle-down"></i>
                    </div>
                </a>

                <div class="collapse" :id="'menu'+menu.label.replace(/\s+/g,'_')" data-bs-parent="#accordionSidenav">
                    <nav class="sidenav-menu-nested nav">
                        <router-link v-for="child_menu in menu.children" :to="child_menu.url" class="nav-link">
                            {{ child_menu.label }}
                        </router-link>
                    </nav>
                </div>
            </template>

            <template v-else>
                <router-link :to="menu.url" class="nav-link">
                    <div class="nav-link-icon">
                        <i :class="menu.icon"></i>
                    </div>
                    {{ menu.label }}
                </router-link>
            </template>
        </section>

    </section>

</template>

<script>
export default {
    name: "SidebarAccordion",
    props: ['main_menus']
}
</script>

<style scoped>

</style>
