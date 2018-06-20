<template>
    <div>
        <h3><small>Postbacks:</small> {{ postback.value }}</h3>
        
        <form @submit.prevent="save()" id="form-new-postback" v-if="showEditForm">
            <legend>Editar postback</legend>
            <div class="input-field">
                <input id="value_to_postback" type="text" v-model="postback.value" required="">
                <label for="value_to_postback" class="active">Identificação do postback</label>
            </div>
            <input type="submit" value="Editar" class="btn">
        </form>
        
        <p>
            <router-link :to="{path: '/'}">Voltar</router-link>
            <a @click.prevent="showEditForm = !showEditForm" href="">Editar</a>
            <a href="">Remover</a>
        </p>
    </div>
</template>

<script>
    import swal from 'sweetalert'
    export default {
        data: function () {
            return {
                showEditForm: false
            }
        },
        methods: {
            save() {
               let data = {
                   id: this.$route.params.id,
                   data: {
                       value: this.postback.value
                   }
               } 
               this.$store.dispatch('updatePostback', data).then(() => {
                   swal('Editado com sucesso!', 'O bot já deve responder a este postack', 'success', {timer: 1800})
                   this.showEditForm = false
               })
            }
        },
        computed: {
            postback() {
                return this.$store.state.postback.postback
            }
        },
        mounted() {
            this.$store.dispatch('getPostback', this.$route.params.id)
        }
    }
</script>