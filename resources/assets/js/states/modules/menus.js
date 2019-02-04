export default {
    state: {
        listMenus: {data: []},
        menu: {}
    },
    mutations: {
        updateMenuList(state, data) {
            state.listMenus = data
        },
        updateMenu(state, data) {
            state.menu = data
        }
    },
    actions: {
        getMenus(context) {
            return window.axios.get('menus').then(response => {
                context.commit('updateMenuList', response.data)
            })
        },
        getMenu(context, id) {
            return window.axios.get('menus/' + id).then(response => {
                context.commit('updateMenu', response.data)
            })
        },
        newMenu(context, data) {
            return window.axios.post('menus', data)
        },
        updateMenu(context, data) {
            return window.axios.put('menus/' + data.id, data.data)
        },
        removeMenu(context, id) {
            return window.axios.delete('menus/' + id)
        },
        sendToFacebook(context, id) {
            return window.axios.get('menu/set-menu/' + id)
        },
        removeFromFacebook(context) {
            return window.axios.get('menu/remove-menu')
        },
        
    }
}