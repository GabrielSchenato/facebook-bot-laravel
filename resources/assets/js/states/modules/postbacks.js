export default {
    state: {
        listPostbacks: {data: []},
        postback: {}
    },
    mutations: {
        updatePostbackList(state, data) {
            state.listPostbacks = data
        },
        updatePostback(state, data) {
            state.postback = data
        }
    },
    actions: {
        getPostbacks(context) {
            return window.axios.get('postbacks').then(response => {
                context.commit('updatePostbackList', response.data)
            })
        },
        getPostback(context, id) {
            return window.axios.get('postbacks/' + id).then(response => {
                context.commit('updatePostback', response.data)
            })
        },
        newPostback(context, data) {
            return window.axios.post('postbacks', data)
        },
        updatePostback(context, data) {
            return window.axios.put('postbacks/' + data.id, data.data)
        },
        removePostback(context, id) {
            return window.axios.delete('postbacks/' + id)
        },
        addGetStarted(context, id) {
            return window.axios.post('postbacks/get-started-button/' + id)
        },
        removeGetStarted(context) {
            return window.axios.delete('postbacks/get-started-button')
        }
    }
}