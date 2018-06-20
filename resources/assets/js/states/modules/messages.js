export default {
    state: {
        listMessages: {data: []},
        message: {}
    },
    mutations: {
        updateMessageList(state, data) {
            state.listMessages = data
        },
        updateMessage(state, data) {
            state.message = data
        }
    },
    actions: {
        getMessages(context) {
            return window.axios.get('api/v1/messages').then(response => {
                context.commit('updateMessageList', response.data)
            })
        },
        getMessage(context, id) {
            return window.axios.get('api/v1/messages/' + id).then(response => {
                context.commit('updateMessage', response.data)
            })
        },
        newMessage(context, data) {
            return window.axios.post('api/v1/messages', data)
        },
        updateMessage(context, data) {
            return window.axios.put('api/v1/messages/' + data.id, data.data)
        },
        removeMessage(context, id) {
            return window.axios.delete('api/v1/messages/' + id)
        }
    }
}