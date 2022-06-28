const dashboardUserRoute = [
    {
        path: '/users',
        component: () => import('./users/Users')
    },
    {
        path: '/user/:id',
        component: () => import('./users/CreateUser'),
        name: 'edit-user'
    },
    {
        path: '/create-user',
        component: () => import('./users/CreateUser')
    },
    {
        path: '/roles',
        component: () => import('./roles/Roles')
    },
    {
        path: '/create-role',
        component: () => import('./roles/CreateRole')
    },
    {
        path: '/edit-role/:id',
        name: 'editRole',
        component: () => import('./roles/EditRole')
    },
]

export default dashboardUserRoute
