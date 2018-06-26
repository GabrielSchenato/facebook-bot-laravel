<template>
    <div>
        <h3>
            <small>Menu:</small> `{{ menu.locale }}`
        </h3>  
        <p>
            <router-link :to="{path: '/menus'}" class="btn">Voltar</router-link>
            <a @click.prevent="sendToFacebook()" class="btn green">Sincronizar</a>
            <a @click.prevent="remove()" class="btn red">Remover</a>
        </p>
        
        <div v-if="menu.menu_buttons.length > 0">
            <div v-for="menu_buttons in menu.menu_buttons" v-if="menu_buttons.parent_id == 0">
                <div class="waves-effect waves-light btn-large grey">
                    {{ menu_buttons.title }} <small>{{ menu_buttons.type | menus_types }} {{ menu_buttons.value }}</small>
                </div>
                <div class="waves-effect waves-light child btn-large grey"
                     v-for="child_menu_buttons in menu.menu_buttons"
                     v-if="child_menu_buttons.parent_id === menu_buttons.id"
                >
                    {{ child_menu_buttons.title }} <small>{{ child_menu_buttons.type | menus_types }} {{ child_menu_buttons.value }}</small>
                </div>
            </div>
        </div>
        
        <div class="card red" v-if='menu.menu_buttons.length === 0'>
            <div class="card-content white-text">
                Nenhum botão cadastrado...
            </div>
        </div>
        
        <form @submit.prevent="create()" id="addButton" class="grey lighten-5">
            <strong>Novo botão:</strong>
            <div class="">
                <select required v-model="newButton.type" class="browser-default">
                    <option value="" disabled>Tipo do botão</option>
                    <option value="nested">Aninhado</option>
                    <option value="postback">Postback</option>
                    <option value="web_url">Link</option>
                </select>
            </div>
            <div class="input-field inline">
                <input type="text" v-model="newButton.title" required maxlength="20">
                <label class="active">Título</label>
            </div>
            <div class="input-field inline" v-if="newButton.type === 'postback'">
                <input type="text" v-model="newButton.value" required maxlength="20">
                <label class="active">Postback destino</label>
            </div>
            <div class="input-field inline" v-if="newButton.type === 'web_url'">
                <input type="text" v-model="newButton.value" required>
                <label class="active">Link</label>
            </div>
            <div class="">
                <select v-model="newButton.parent_id" class="browser-default">
                    <option value="" disabled>Botão pai</option>
                    <option value="0">Nenhum</option>
                    <option v-for="menu_buttons in menu.menu_buttons" :value="menu_buttons.id">{{ menu_buttons.title }}</option>
                </select>
            </div>
            <hr>
            <input type="submit" value="+" class="btn">
        </form>
        
    </div>
</template>

<script>    
    export default {
        data: function () {
            return {
                newButton: {
                    type: "",
                    parent_id: ""
                }
            }
        },
        computed: {
            menu() {
                let menu = this.$store.state.menu.menu
                return menu.menu_buttons ? menu : {menu_buttons: []}
            }
        },
        mounted() {
            this.$store.dispatch('getMenu', this.$route.params.id)
        }
    }
</script>

<style>
    #addButton{
      margin-top: 40px;
      padding: 10px;
      border-radius: 2px;
    }
    .child.btn-large{
      margin-left: 30px;
    }
</style>
