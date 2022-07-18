const authRoutes = [
    {
        path: 'login',
        component: () => import('../views/auth/Login'),
        name: 'auth.login',
        meta: {
            title: 'Login'
        }
    },
    {
        path: 'registration',
        component: () => import('../views/auth/Registration'),
        name: 'auth.registration',
        meta: {
            title: 'Registration'
        }
    },
    {
        path: 'forget-password',
        component: () => import('../views/auth/ForgetPassword'),
        name: 'auth.forgetPassword',
        meta: {
            title: 'Forget Password'
        }
    },
    {
        path: 'reset-password/:token',
        component: () => import('../views/auth/ResetPassword'),
        name: 'auth.resetPassword',
        meta: {
            title: 'Reset Password'
        }
    }
]

export default authRoutes
