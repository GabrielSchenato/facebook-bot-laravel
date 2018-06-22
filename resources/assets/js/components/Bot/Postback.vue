<template>
    <div>
        <h3>Postbacks</h3>

        <div v-if="postbacks.data.length > 0">
            <router-link
                v-for="postback in postbacks.data"
                class="waves-effect waves-light btn-large light-green btn-postback"
                :to="{path: '/postback/' + postback.id}"
                >
                <i class="material-icons" v-if="postback.get_started">done_all</i> {{ postback.value }} <small v-if="postback.get_started">Botão começar</small>
            </router-link>
        </div>

        <div class="card red" v-if="postbacks.data.length === 0">
            <div class="card-content white-text">
                Nenhum postback...
            </div>
        </div>

        <form @submit.prevent="save()" id="form-new-postback">
            <legend>Novo postback</legend>
            <div class="input-field">
                <input id="value_to_postback" type="text" v-model="title" required="">
                <label for="value_to_postback">Identificação do postback</label>
            </div>
            <input type="submit" value="+" class="btn">
        </form>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                title: ''
            }
        },
        computed: {
            postbacks() {
                return this.$store.state.postback.listPostbacks
            }
        },
        methods: {
            save() {
                this.$store.dispatch('newPostback', {'value': this.title}).then(() => {
                    this.$store.dispatch('getPostbacks')
                    this.title = ''
                })
            }
        },
        mounted() {
            this.$store.dispatch('getPostbacks')
        }
    }
</script>
<style>
    #form-new-postback {
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .btn-postback {
        display:block;
        text-align: left;
        margin-bottom: 10px;
    }
</style>