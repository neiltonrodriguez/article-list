import { createRouter, createWebHashHistory } from "vue-router";
import { useAuth } from '../stores/auth.js'

const routes = [
    {
        path: '/login',
        name: 'login',
        component: () => import(/* webpackChunkName: "login" */ '../pages/Login.vue'),
        meta: {
            auth: false
        }
    },
    {
        path: '/',
        name: 'articles',
        component: () => import(/* webpackChunkName: "articles" */ '../pages/Home.vue'),
        meta: {
            auth: false
        }
    },
    {
        path: '/:id',
        name: 'article',
        component: () => import(/* webpackChunkName: "article" */ '../pages/ArticleDetails.vue'),
        meta: {
            auth: false
        }
    },
    {
        path: '/dashboard',
        name: 'dashboard',
        component: () => import(/* webpackChunkName: "dashboard" */ '../pages/Dashboard.vue'),
        meta: {
            auth: true
        },
        children: [
            {
                path: '/dashboard',
                name: 'articles-list',
                component: () => import(/* webpackChunkName: "articles-list" */ '../pages/ArticlesList.vue'),
                meta: {
                    auth: true
                },
            },
        ]
    },
]

const router = createRouter({
    history: createWebHashHistory(),
    routes
})

router.beforeEach(async (to, from, next) => {
    if (to.meta?.auth) {
        const auth = useAuth()
        if (auth.token) {
            const isAuthenticated = await auth.checkToken()
            if (isAuthenticated) {
                next()
            } else {
                next({ name: 'login' })
            }

        } else {
            next({ name: 'login' })
        }
    } else {
        next()
    }
})

export default router