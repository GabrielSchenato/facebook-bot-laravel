import postbacks from './modules/postbacks'
import messages from './modules/messages'
import elements from './modules/elements'
import products from './modules/products'
import menus from './modules/menus'
import menuButtons from './modules/menuButtons'
import user from './modules/user'

export default{
    modules: {
        postback: postbacks,
        message: messages,
        element: elements,
        product: products,
        menu: menus,
        menuButton: menuButtons,
        user: user
    }
}