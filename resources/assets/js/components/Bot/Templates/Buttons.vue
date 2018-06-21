<template>
    <div>
        <div v-if="elements.data.length > 0">
            <strong>Botões: </strong>
            <div v-for="element in elements.data" class="chip">
                {{ element.title }} - postback: {{ element.postback }}
                <a href="" class="btn-floating red"><i class="material-icons">close</i></a>
            </div>
        </div>

        <div class="card red">
            <div class="card-content white-text">
                Nenhum botão...
            </div>
        </div>

        <form class="grey lighten-4" id="button-add">
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
                <input type="text" placeholder="Qual destino..." v-model="dataToSave.postback" required maxlength="20">
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