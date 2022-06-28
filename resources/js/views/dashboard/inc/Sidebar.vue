<template>
    <div id="layoutSidenav_nav">
        <nav class="sidenav shadow-right sidenav-light">
            <div class="sidenav-menu">
                <div class="nav accordion" id="accordionSidenav">

                    <!--                    <div class="sidenav-menu-heading d-sm-none">Account</div>
                                        <a class="nav-link d-sm-none" href="#!">
                                            <div class="nav-link-icon"><i class="far fa-bell"></i></div>
                                            Alerts
                                            <span class="badge bg-warning-soft text-warning ms-auto">4 New!</span>
                                        </a>
                                        <a class="nav-link d-sm-none" href="#!">
                                            <div class="nav-link-icon"><i class="far fa-envelope"></i></div>
                                            Messages
                                            <span class="badge bg-success-soft text-success ms-auto">2 New!</span>
                                        </a>-->

                    <!-- Sidenav Accordion (Dashboard)-->
                    <SidebarAccordion :main_menus="menus"></SidebarAccordion>


                </div>
            </div>
            <!-- Sidenav Footer-->
            <div class="sidenav-footer">
                <div class="sidenav-footer-content">
                    <div class="sidenav-footer-subtitle">Logged in as:</div>
                    <div class="sidenav-footer-title">{{ user.name }}</div>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
import SidebarAccordion from "@/components/dashboard/SidebarAccordion";

export default {
    name: 'Sidebar',
    components: {
        SidebarAccordion
    },
    mounted() {
        console.log(this.$store.state.user.menus)
    },
    data() {
        return {
            user: this.$store.state.user,
            menus: this.$store.state.user.menus,
            main_menus: [
                {
                    group: 'core',
                    menus: [
                        {
                            title: 'Dashboard',
                            url: '/dashboard',
                            icon: 'fa fa-search'
                        }
                    ]
                },
                {
                    group: 'user management',
                    menus: [
                        {
                            title: 'User Management',
                            icon: 'fas fa-user',
                            url: '',
                            children: [
                                {
                                    title: 'Users',
                                    url: '/users',
                                    icon: 'fas fa-user'
                                },
                                {
                                    title: 'Roles',
                                    url: '/roles',
                                    icon: 'fa fa-user'
                                }
                            ]
                        },
                        {
                            title: 'File Manager',
                            url: '/file-manager',
                            icon: 'fas fa-folder'
                        }
                    ]
                }
            ]
        }
    }
}
</script>
