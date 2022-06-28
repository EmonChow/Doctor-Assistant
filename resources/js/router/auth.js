const authRoutes = [
    {
        path: 'login',
        component: () => import('../views/auth/Login'),
        name: 'login',
        meta: {
            title: 'Login'
        }
    }
]

export default authRoutes
