import dashboardSettings from "../views/dashboard/pages/settings/routes";
import dashboardUserRoute from "../views/dashboard/pages/user_management/routes";

const dashboardRoutes = [
    {
        path: '',
        component: () => import('../views/dashboard/pages/Home'),
        name: 'dashboard',
        meta: {
            title: 'Dashboard', auth: true
        }
    },
    {
        path: '/',
        component: () => import('../views/dashboard/Blank'),
        children: dashboardSettings
    },
    {
        path: '/',
        component: () => import('../views/dashboard/Blank'),
        children: dashboardUserRoute
    }
]

export default dashboardRoutes
