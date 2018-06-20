<template>
    <div>
        <div>
            {{ postbacks }}
        </div>
        <form @submit.prevent="save()">
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
        data: function() {
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
