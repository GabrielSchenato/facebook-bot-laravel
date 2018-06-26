import postbacks from './modules/postbacks'
import messages from './modules/messages'
import elements from './modules/elements'
import products from './modules/products'
import menus from './modules/menus'

export default{
    modules: {
        postback: postbacks,
        message: messages,
        element: elements,
        product :products,
        menu :menus
    }
}