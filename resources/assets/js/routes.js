import ExampleComponent from './components/ExampleComponent'
import Login from './components/Login'

export default [
    { path: '/', component: ExampleComponent, meta: { requiresAuth: true } },
    { path: '/login', component: Login, meta: { requiresAuth: false } }
]