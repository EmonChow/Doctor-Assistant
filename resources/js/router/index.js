import {createRouter, createWebHistory} from "vue-router";
import websiteRoutes from "./website";
import authRoutes from "./auth";
import store from "../store";
import dashboardRoutes from "./dashboard";

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
        children: authRoutes,
        meta: {
            guard: 'guest'
        }
    },
    {
        path: '/dashboard',
        component: () => import('../views/dashboard/Layout'),
        children: dashboardRoutes,
        meta: {
            guard: 'auth'
        },
    },
    {
        path: '/:catchAll(.*)',
        component: () => import('../views/errors/NotFound')
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
    document.title = to.meta?.title + ` - ${import.meta.env.VITE_APP_NAME}`
})

router.beforeEach((to, from, next) => {
    window.scrollTo(0, 0)
    if (to.matched.some(record => record.meta.guard === 'auth')) {
        if (store.state.auth_token == null) {
            next({path: '/auth/login'})
        } else {
            next()
        }
    } else if (to.matched.some(record => record.meta.guard === 'guest')) {
        if (store.state.auth_token == null) {
            next()
        } else {
            next({name: 'dashboard'})
        }
    } else {
        next()
    }
})

export default router
