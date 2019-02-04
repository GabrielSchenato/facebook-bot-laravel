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
            return window.axios.get('messages').then(response => {
                context.commit('updateMessageList', response.data)
            })
        },
        getMessage(context, id) {
            return window.axios.get('messages/' + id).then(response => {
                context.commit('updateMessage', response.data)
            })
        },
        newMessage(context, data) {
            return window.axios.post('messages', data)
        },
        updateMessage(context, data) {
            return window.axios.put('messages/' + data.id, data.data)
        },
        removeMessage(context, id) {
            return window.axios.delete('messages/' + id)
        },
        setMessageProduct (context, params){
            return window.axios.post('messages/' + params.id + '/product', { product_id: params.product_id })
        },
        getMessageProduct (context, id){
            return window.axios.get('messages/' + id + '/product')
        },
        removeMessageProduct (context, params){
            return window.axios.delete('messages/' + params.id + '/product/' + params.product_id)
        }
    }
}