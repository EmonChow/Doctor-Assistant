import {createRouter, createWebHistory} from "vue-router";
import websiteRoutes from "./website";
import authRoutes from "./auth";

/**
 * Main Route File
 * All Route file must be registered in the routes array
 * @type {*[]}
 */
const routes = [
    {
        path: '',
        component: () => import('../views/webpages/Layout'),
        children: websiteRoutes
    },
    {
        path: '/auth',
        component: () => import('../views/auth/Layout'),
        children: authRoutes
    }
]


/**
 * Create Route
 *
 * @type {Router}
 */
const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    linkActiveClass: 'active',
    routes
})

/**
 * Set Document Title after each route
 */
router.afterEach((to, from) => {
    document.title = to.meta?.title
})

export default router
