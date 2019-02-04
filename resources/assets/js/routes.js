import Postback from './components/Bot/Postback'
import PostbackView from './components/Bot/PostbackView'

import Login from './components/Auth/Login'
import Register from './components/Auth/Register'

import ProductsList from './components/Products/ProductsList'
import ProductRemove from './components/Products/ProductRemove'
import ProductEdit from './components/Products/ProductEdit'

import Menu from './components/Menus/Menu'
import MenuView from './components/Menus/MenuView'

import SuggestionsList from './components/Suggestions/SuggestionsList'

import NotFoundPage from './components/NotFoundPage'

export default [
    { path: '/', component: Postback, meta: { auth: true } },

    { path: '/login', component: Login, meta: { auth: false } },
    { path: '/register', component: Register, meta: { auth: false } },

    {
        path: '/postback/:id', component: PostbackView,
        meta: {
            auth: {
                roles: ['admin'],
                redirect: {
                    name: 'admin'
                },
                forbiddenRedirect: '/admin/403'
            }
        }
    },

    { path: '/products', component: ProductsList, meta: { auth: true } },
    { path: '/product/:id/remove', component: ProductRemove, meta: { auth: true } },
    { path: '/product/:id/edit', component: ProductEdit, meta: { auth: true } },

    { path: '/menus', component: Menu, meta: { auth: true } },
    { path: '/menu/:id', component: MenuView, meta: { auth: true } },

    { path: '/suggestions', component: SuggestionsList, meta: { auth: true } },

    { path: '*', component: NotFoundPage, meta: { auth: undefined } },
]