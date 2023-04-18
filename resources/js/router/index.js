import { createWebHistory, createRouter } from 'vue-router'
import store from '@/store'

/* Guest Component */
const Login = () => import('@/components/authentication/Login.vue')
const Register = () => import('@/components/authentication/Register.vue')
/* Guest Component */

/* Layouts */
const DahboardLayout = () => import('@/components/layouts/Default.vue')
/* Layouts */

/* Authenticated Component */
const Dashboard = () => import('@/components/Dashboard.vue')
/* Authenticated Component */


const routes = [
    {
        name: "login",
        path: "/login",
        component: Login,
        meta: {
            middleware: "guest",
            title: `Login`
        }
    },
    {
        name: "register",
        path: "/register",
        component: Register,
        meta: {
            middleware: "guest",
            title: `Register`
        }
    },
    {
        path: "/",
        component: DahboardLayout,
        meta: {
            middleware: "auth"
        },
        children: [
            {
                name: "dashboard",
                path: '/',
                component: Dashboard,
                meta: {
                    title: `Dashboard`
                }
            }
        ]
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes, // short for `routes: routes`
})

router.beforeEach( async (to, from, next) => {
    document.title = to.meta.title
    if (to.meta.middleware == "guest") {
        await axios.get('/api/auth/user')
        .then(response => {
            next({ name: "dashboard" })
        })
        .catch(error => {
            if (error.response && error.response.status === 401) {
                next() 
            } else {
            console.log(error.response)
            }
        });
        
    } else {

        await axios.get('/api/auth/user')
        .then(response => {
            next()
        })
        .catch(error => {
            if (error.response && error.response.status === 401) {
                next({ name: "login" })
            } else {
            console.log(error.response)
            }
        });
    }
})

export default router