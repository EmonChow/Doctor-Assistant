const dashboardSettings = [
    {
        path: 'profile',
        name: 'profile',
        component: () => import('./Profile'),
        meta: {
            title: 'Profile'
        }
    },
    {
        path: 'change-email',
        name: 'changeEmail',
        component: () => import('./ChangeEmail'),
        meta: {
            title: 'Change Email Address'
        }
    },
    {
        path: 'change-password',
        name: 'changePassword',
        component: () => import('./ChangePassword'),
        meta: {
            title: 'Change Password'
        }
    },
    {
        path: 'security',
        name: 'security',
        component: () => import('./Security'),
        meta: {
            title: 'Security & Login'
        }
    },
    {
        path: 'file-manager',
        name: 'fileManager',
        component: () => import('./FileManager'),
        meta: {
            title: 'File Manager'
        }
    }
]

export default dashboardSettings
