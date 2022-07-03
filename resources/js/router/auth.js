const   authRoutes = [
    {
        path: 'login',
        component: () => import('../views/auth/Login'),
        name: 'login',
        meta: {
            title: 'Login'
        }
    },
    {
        path: 'registration',
        component: () => import('../views/auth/Registration'),
        name: 'registration',
        meta: {
            title: 'Registration'
        }
    },
    {
        path: 'forget-password',
        component: () => import('../views/auth/ForgetPassword'),
        name: 'forgetPassword',
        meta: {
            title: 'Forget Password'
        }
    },
    {
        path: 'reset-password',
        component: () => import('../views/auth/ResetPassword'),
        name: 'resetPassword',
        meta: {
            title: 'Reset Password'
        }
    }
]

export default authRoutes
