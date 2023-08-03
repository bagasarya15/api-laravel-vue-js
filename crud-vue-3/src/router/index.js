//import vue router
import { createRouter, createWebHistory } from 'vue-router'

//define a routes
const routes = [
    {
        path: '/',
        name: 'IndexHome',
        component: () => import( /* webpackChunkName: "IndexHome" */ '@/views/Index.vue')
    },
    {
        path: '/post',
        name: 'PostIndex',
        component: () => import( /* webpackChunkName: "PostIndex" */ '@/views/post/Index.vue')
    },
    {
        path: '/post/create',
        name: 'PostCreate',
        component: () => import( /* webpackChunkName: "PostCreate" */ '@/views/post/Create.vue')
    },
    {
        path: '/post/edit/:id',
        name: 'PostEdit',
        component: () => import( /* webpackChunkName: "PostEdit" */ '@/views/post/Edit.vue')
    }
]

//create router
const router = createRouter({
    history: createWebHistory(),
    routes  // config routes
})

export default router