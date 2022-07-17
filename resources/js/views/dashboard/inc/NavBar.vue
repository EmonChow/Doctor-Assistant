<template>
    <nav
        class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white"
        id="sidenavAccordion">
        <!-- Sidenav Toggle Button-->
        <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0"
                @click="toggleSidebar"
                id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <!-- Navbar Brand-->
        <!-- * * Tip * * You can use text or an image for your navbar brand.-->
        <!-- * * * * * * When using an image, we recommend the SVG format.-->
        <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
        <router-link to="/" class="navbar-brand pe-3 ps-4 ps-lg-2">{{ siteTitle }}</router-link>
        <!-- Navbar Search Input-->
        <!-- * * Note: * * Visible only on and above the lg breakpoint-->
        <!--        <form class="form-inline me-auto d-none d-lg-block me-3">
                    <div class="input-group input-group-joined input-group-solid">
                        <input
                            class="form-control pe-0"
                            type="search"
                            placeholder="Search"
                            aria-label="Search"
                        />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>-->
        <!-- Navbar Items-->
        <ul class="navbar-nav align-items-center ms-auto">

            <!-- Alerts Dropdown-->

            <!-- Messages Dropdown-->
            <li
                class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications"
            >
                <a
                    class="btn btn-icon btn-transparent-dark dropdown-toggle"
                    id="navbarDropdownMessages"
                    href="javascript:void(0);"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                ><i class="far fa-envelope"></i></a>
                <div
                    class="
            dropdown-menu dropdown-menu-end
            border-0
            shadow
            animated--fade-in-up
          "
                    aria-labelledby="navbarDropdownMessages"
                >
                    <h6 class="dropdown-header dropdown-notifications-header">
                        <i class="me-2" data-feather="mail"></i>
                        Language Center
                    </h6>
                    <!-- Example Message 1  -->
                    <a v-for="lang in langs" class="dropdown-item dropdown-notifications-item"
                       @click="setLanguage(lang.value)">
                        <div class="dropdown-notifications-item-content">
                            <div class="dropdown-notifications-item-content-text">
                                {{ lang.title }}
                            </div>
                        </div>
                    </a>

                </div>
            </li>
            <!-- User Dropdown-->
            <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
                <a
                    class="btn btn-icon btn-transparent-dark dropdown-toggle"
                    id="navbarDropdownUserImage"
                    href="javascript:void(0);"
                    role="button"
                    data-bs-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    <img v-if="!user.photo"
                         class="img-fluid"
                         src="@/assets/img/illustrations/profiles/profile-1.png"
                    />


                    <img v-else
                         class="img-fluid"
                         :src="user.photo"
                    />
                </a>
                <div
                    class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up"
                    aria-labelledby="navbarDropdownUserImage"
                >
                    <h6 class="dropdown-header d-flex align-items-center">
                        <img v-if="!user.photo"
                             class="dropdown-user-img"
                             src="@/assets/img/illustrations/profiles/profile-1.png"
                        />
                        <img v-else :src="user.photo" class="dropdown-user-img" alt="">
                        <div class="dropdown-user-details">
                            <div class="dropdown-user-details-name">{{ user.name }}</div>
                            <div class="dropdown-user-details-email">{{ user.email }}</div>
                        </div>
                    </h6>
                    <div class="dropdown-divider"></div>
                    <router-link class="dropdown-item" :to="{name: 'profile'}">
                        <div class="dropdown-item-icon">
                            <i data-feather="settings"></i>
                        </div>
                        Account
                    </router-link>

                    <a class="dropdown-item" @click="logout" href="javascript:void(0);">
                        <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                        Logout 1
                    </a>
                </div>
            </li>
        </ul>
    </nav>
</template>

<script>
import axios from "../../../services/apiService";

export default {
    name: "Navbar",
    data() {
        return {
            siteTitle: import.meta.env.VITE_APP_NAME,
            user: this.$store.state.user,
            langs: [
                {title: 'Bangla', value: 'bn'},
                {title: 'English', value: 'en'},
            ]
        }
    },
    methods: {
        toggleSidebar() {
            document.body.classList.toggle('sidenav-toggled');
            localStorage.setItem(
                'sb|sidebar-toggle',
                document.body.classList.contains('sidenav-toggled')
            );
        },

        logout() {
            axios.post('/logout').then(response => {
                this.$store.commit('SET_AUTH_TOKEN', null);
                this.$store.commit('SET_USER', null);
                this.$router.push({name: 'auth.login'})
            })
        },

        setLanguage(lang) {
            this.$i18n.locale = lang
            alert(this.$i18n.locale)
        }
    }
};
</script>
