import ExampleComponent from './components/ExampleComponent'
import Login from './components/Auth/Login'
import Register from './components/Auth/Register'

export default [
    { path: '/', component: ExampleComponent, meta: { requiresAuth: true } },
    { path: '/login', component: Login, meta: { requiresAuth: false } },
    { path: '/register', component: Register, meta: { requiresAuth: false } }
]