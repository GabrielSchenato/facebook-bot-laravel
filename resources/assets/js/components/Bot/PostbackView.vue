<template>
    <div>
        <h3><small>Postbacks:</small> {{ postback.value }}</h3>
        
        <form @submit.prevent="save()" id="form-new-postback" v-if="showEditForm">
            <legend>Editar postback</legend>
            <div class="input-field">
                <input id="value_to_postback" type="text" v-model="postback.value" required="">
                <label for="value_to_postback" class="active">Identificação do postback</label>
            </div>
            <input type="submit" value="Atualizar" class="btn">
        </form>
        
        <p>
            <router-link :to="{path: '/'}" class="btn waves-effect waves-light">Voltar</router-link>
            <a @click.prevent="addGetStartedButton()" href="" v-if="!postback.get_started" class="btn green waves-effect waves-light">Definir como botão começar</a>
            <a @click.prevent="removeGetStartedButton()" href="" v-if="postback.get_started" class="btn green waves-effect waves-light">Remover botão começar</a>
            <a @click.prevent="showEditForm = !showEditForm" href="" class="btn blue waves-effect waves-light">Editar</a>
            <a @click.prevent="remove()" href="" class="btn red waves-effect waves-light">Remover</a>
        </p>
    </div>
</template>

<script>
    import swal from 'sweetalert'
    export default {
        data: function() {
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
                        swal('Editado com sucesso!', 'O bot já deve responder a este postack', 'success', {
                            timer: 1800
                        })
                        this.showEditForm = false
                    })
                },
            remove() {
                    swal({
                            title: "Removendo!!!",
                            text: "Você está removendo este postback e não poderá desfazer esta ação!",
                            icon: "warning",
                            buttons: ["Cancelar!", "Deletar!"],
                            dangerMode: true
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                this.$store.dispatch('removePostback', this.$route.params.id).then(() => {
                                    swal("Removido!", "Removido com sucesso.", "success")
                                    this.$router.push("/")
                                })
                            } else {
                                swal("Seu postback está salvo!", {timer: 1000});
                            }
                        })

                },
            addGetStartedButton() {
                    swal({
                            title: "Botão começar!!!",
                            text: "Você tem certeza que quer definir este postback como ação do botão começar?",
                            icon: "warning",
                            buttons: ["Não!", "Sim!"],
                        })
                        .then((willAdd) => {
                            if (willAdd) {
                                this.$store.dispatch('addGetStarted', this.$route.params.id).then(() => {
                                    swal("Processo concluido!", "Botão começar agora vai começar a responder por este postback", "success")
                                    this.$store.dispatch('getPostback', this.$route.params.id)
                                })
                            } else {
                                swal("Nada mudou!", {timer: 800});
                            }
                        })

                },
            removeGetStartedButton() {
                    swal({
                            title: "Removendo botão começar!!!",
                            text: "Você está desativando o botão começar, você poderá desfazer essa ação a qualquer momento!",
                            icon: "warning",
                            buttons: ["Cancelar!", "Deletar!"],
                            dangerMode: true
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                this.$store.dispatch('removeGetStarted').then(() => {
                                    swal("Botão começar desativado!", "Para desfazer essa ação clique em Definir como botão começar.", "success")
                                })
                            } else {
                                swal("Seu botão está salvo!", {timer: 1000});
                            }
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