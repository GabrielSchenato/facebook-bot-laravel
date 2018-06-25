<template>
    <div>
        <div v-if="elements.data.length > 0">
            <p><strong>Botões: </strong></p>
            <div v-for="element in elements.data" class="chip">
                {{ element.title }} - postback: {{ element.postback }}
                <a href="" class="btn-floating red" @click.prevent="removeButton(element.id)"><i class="material-icons">close</i></a>
            </div>
        </div>

        <div class="card red" v-if="elements.data.length === 0">
            <div class="card-content white-text">
                Nenhum botão...
            </div>
        </div>

        <form class="grey lighten-4" id="button-add" @submit.prevent="newButton()">
            <strong>Novo botão:</strong>
            <div class="">
                <select class="browser-default" v-model="dataToSave.type" required>
                    <option value="" disabled="" selected="">Escolha o tipo do botão</option>
                    <option value="postback">Postback</option>
                    <option value="web_url">Link</option>
                    <option value="web_url_compact">Web View Compacta</option>
                    <option value="web_url_tall">Web View Alta</option>
                    <option value="web_url_full">Web View Completa</option>
                </select>
            </div>
            <div class="input-field inline">
                <input type="text" placeholder="Título do botão..." v-model="dataToSave.title" required maxlength="20">
                <label class="active">Título</label>
            </div>
            <div class="input-field inline">
                <input type="text" placeholder="Qual destino..." v-model="dataToSave.postback" required>
                <label class="active">Destino</label>
            </div>
            <input id="elementSaveBtn" type="submit" value="+" class="btn">
        </form>

    </div>
</template>

<script>
    export default {
        props: [
            'messageData'
        ],
        data: function () {
            return {
                message: this.messageData,
                dataToSave: {
                    type: ''
                },
                elements: {data: []}
            }
        },
        methods: {
            newButton() {
                let data = {
                    type: this.dataToSave.type,
                    title: this.dataToSave.title,
                    postback: this.dataToSave.postback,
                    message_id: this.message.id
                }
                
                if(data.type === 'web_url_compact'){
                    data.type = 'web_url'
                    data.webview_height_ratio = 'compact'
                }
                
                if(data.type === 'web_url_tall'){
                    data.type = 'web_url'
                    data.webview_height_ratio = 'tall'
                }
                
                if(data.type === 'web_url_full'){
                    data.type = 'web_url'
                    data.webview_height_ratio = 'full'
                }
                
                this.$store.dispatch('newElement', data).then(() => {
                    this.dataToSave = { type: '' }
                    this.$store.dispatch('getElements', this.message.id).then((response) => {
                        this.elements = response.data
                    })
                })
            },
            removeButton(id) {
                this.$store.dispatch('removeElement', id).then(() => {
                    this.$store.dispatch('getElements', this.message.id).then((response) => {
                        this.elements = response.data
                    })
                })
            }
        },
        mounted () {
            this.$store.dispatch('getElements', this.message.id).then((response) => {
                this.elements = response.data
            })
        }
    }
</script>

<style>
    #button-add {
        margin-top: 40px;
        padding: 10px;
        border-radius: 2px;
    }
    .btn-floating {
        width: 20px;
        height: 20px;
        line-height: 20px;
    }
    .btn-floating i {
        font-size: 15px;
        line-height: 20px;
    }
</style>