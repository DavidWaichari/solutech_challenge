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
import UsersList from '../components/users/List.vue';
import CreateUser from '../components/users/Create.vue';
import StatusList from '../components/task_status/List.vue';
import CreateStatus from '../components/task_status/Create.vue';
import TasksList from '../components/tasks/List.vue';
import CreateTask from '../components/tasks/Create.vue';
import UsersTaskList from '../components/user_tasks/List.vue';
import CreateUserTask from '../components/user_tasks/Create.vue';
import UserTasks from '../components/users/UserTasks.vue';
import StatusUserTasks from '../components/task_status/StatusUserTasks.vue';

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
            },
            {
                name: "users.create",
                path: '/users_create',
                component: CreateUser,
                meta: {
                    title: `CreateUser`
                }
            },
            {
                name: "users",
                path: '/users',
                component: UsersList,
                meta: {
                    title: `UsersList`
                }
            },
            {
                name: "task_status",
                path: '/task_status',
                component: StatusList,
                meta: {
                    title: `StatusList`
                }
            },
            {
                name: "task_status.create",
                path: '/task_status_create',
                component: CreateStatus,
                meta: {
                    title: `CreateStatus`
                }
            },
            {
                name: "tasks",
                path: '/tasks',
                component: TasksList,
                meta: {
                    title: `TasksList`
                }
            },
            {
                name: "tasks.create",
                path: '/tasks_create',
                component: CreateTask,
                meta: {
                    title: `CreateTask`
                }
            },
            {
                name: "user_tasks",
                path: '/user_tasks',
                component: UsersTaskList,
                meta: {
                    title: `UsersTaskList`
                }
            },
            {
                name: "user_tasks.create",
                path: '/user_tasks_create',
                component: CreateUserTask,
                meta: {
                    title: `CreateUserTask`
                }
            },
            {
                name: "user_tasks.tasks",
                path: '/users/:userid/tasks',
                component: UserTasks,
                meta: {
                    title: `UserTasks`
                }
            },
            {
                name: "status.user_tasks",
                path: '/status/:status_id/user_tasks',
                component: StatusUserTasks,
                meta: {
                    title: `StatusUserTasks`
                }
            },
            
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
        next()
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