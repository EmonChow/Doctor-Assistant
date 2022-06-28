<template>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <slot name="title">
                            <h1 class="page-header-title">
                                <div class="page-header-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                         fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                         stroke-linejoin="round" class="feather feather-file">
                                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                        <polyline points="13 2 13 9 20 9"></polyline>
                                    </svg>
                                </div>
                                {{ title }}
                            </h1>
                        </slot>


                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <slot name="links">
                            <router-link v-for="link in links" :to="link.url"
                                         class="btn btn-sm btn-light text-primary me-2">
                                {{ link.text }}
                            </router-link>
                        </slot>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
export default {
    name: "Compact",
    props: {
        title: {
            type: String,
            default: 'Default Header',
            required: false
        },
        links: {
            type: Array,
            required: false
        }
    }
}
</script>

<style scoped>

</style>
