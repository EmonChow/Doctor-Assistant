const dashboardUserRoute = [
    {
        path: '/users',
        component: () => import('./users/Users'),
        name: 'users',
        meta: {
            title: 'Users'
        }
    },
    {
        path: '/user/:id',
        component: () => import('./users/CreateUser'),
        name: 'edit-user'
    },
    {
        path: '/create-user',
        component: () => import('./users/CreateUser'),
        name: 'createUser'
    },
    {
        path: '/roles',
        component: () => import('./roles/Roles'),
        name: 'role',
        meta: {
            title: 'Role'
        }
    },
    {
        path: '/create-role',
        component: () => import('./roles/CreateRole'),
        name: 'createRole'
    },
    {
        path: '/edit-role/:id',
        name: 'editRole',
        component: () => import('./roles/EditRole'),
    },
]

export default dashboardUserRoute
