const siteSettings = [
    {
        path: 'sliders',
        name: 'slider',
        component: () => import('./slider/List'),
        meta: {
            name: 'Sliders'
        }
    },
    {
        path: 'create-slider',
        name: 'createSlider',
        component: () => import('./slider/Create'),
        meta: {
            name: 'Create Slider'
        }
    },
    {
        path: 'edit-slider/:id',
        name: 'editSlider',
        component: () => import('./slider/Create'),
        meta: {
            name: 'Edit Slider'
        }
    },
    {
        path: 'website-data',
        name: 'websiteData',
        component: () => import('./website/List'),
        meta: {
            name: 'Website Data'
        }
    },
    {
        path: 'create-site-data',
        name: 'createWebsiteData',
        component: () => import('./website/Create'),
        meta: {
            name: 'Create Website Data'
        }
    },
    {
        path: 'edit-site-data/:id',
        name: 'editWebsiteData',
        component: () => import('./website/Create'),
        meta: {
            name: 'Edit Website Data'
        }
    }
]
export default siteSettings
