const dashboardSettings = [
    {
        path: 'profile',
        name: 'profile',
        component: () => import('./Profile')
    },
    {
        path: 'change-email',
        name: 'changeEmail',
        component: () => import('./ChangeEmail')
    },
    {
        path: 'change-password',
        name: 'changePassword',
        component: () => import('./ChangePassword')
    },
    {
        path: 'file-manager',
        name: 'fileManager',
        component: () => import('./FileManager')
    }
]

export default dashboardSettings
