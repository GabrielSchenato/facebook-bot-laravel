export default {
    state: {
        listMenuButtons: {data: []},
        menu_button: {}
    },
    mutations: {
        updateMenuButtonList(state, data) {
            state.listMenuButtons = data
        },
        updateMenuButton(state, data) {
            state.menu_button = data
        }
    },
    actions: {
        getMenuButtons(context) {
            return window.axios.get('menu-buttons').then(response => {
                context.commit('updateMenuButtonList', response.data)
            })
        },
        getMenuButton(context, id) {
            return window.axios.get('menu-buttons/' + id).then(response => {
                context.commit('updateMenuButton', response.data)
            })
        },
        newMenuButton(context, data) {
            return window.axios.post('menu-buttons', data)
        },
        updateMenuButton(context, data) {
            return window.axios.put('menu-buttons/' + data.id, data.data)
        },
        removeMenuButton(context, id) {
            return window.axios.delete('menu-buttons/' + id)
        }
    }
}