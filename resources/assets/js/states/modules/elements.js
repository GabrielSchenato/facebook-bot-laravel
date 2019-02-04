export default {
    state: {
        listElements: {data: []},
        element: {}
    },
    mutations: {
        updateElementList(state, data) {
            state.listElements = data
        },
        updateElement(state, data) {
            state.element = data
        }
    },
    actions: {
        getElements(context, message_id) {
            return window.axios.get('elements?where[message_id]=' + message_id).then(response => {
                context.commit('updateElementList', response.data)
                return response
            })
        },
        getElement(context, id) {
            return window.axios.get('elements/' + id).then(response => {
                context.commit('updateElement', response.data)
            })
        },
        newElement(context, data) {
            return window.axios.post('elements', data)
        },
        updateElement(context, data) {
            return window.axios.put('elements/' + data.id, data.data)
        },
        removeElement(context, id) {
            return window.axios.delete('elements/' + id)
        }
    }
}