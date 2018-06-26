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
        
    </div>
</template>

<script>    
    export default {
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
    .child.btn-large{
      margin-left: 30px;
    }
</style>
