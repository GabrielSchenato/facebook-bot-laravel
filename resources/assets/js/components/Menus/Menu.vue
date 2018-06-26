<template>
    <div>
        <h3>Menu do bot</h3>
        <button class="btn red margin-botton" @click="removeMenu()">Limpar menu no Facebook</button>
        
        <div v-if="menus.data.lenght > 0">
            <router-link
                v-for="menu in menus.data"
                class="waves-effect waves-light btn-large light-green"
                :to="{path: 'menu/' + menu.id}">
                {{ menu.locale }} <small>Campo de mensagem: {{ menu.composer_input_disabled ? 'ativado' : 'desativado' }}</small>
            </router-link>
        </div>
        
        <div class="card red" v-if='menus.data.lenght === 0'>
            <div class="card-content white-text">
                Nenhum menu cadastrado...
            </div>
        </div>
        
        <form @submit.prevent='save()'>
            <div class="row">
                <legend>Novo menu</legend>
                <div class="input-group col s6">
                    <input type="text" placeholder="Locale" v-model="locale" required>
                </div>
                <div class="input-group col s6">
                    <p><a href="https://developers.facebook.com/docs/messenger-platform/messenger-profile/supported-locales" target="_blank">Clique aqui para ver os locales suportados</a></p>
                </div>
                <div class="input-group margin-botton col s12">
                    <input id='composer_input_disabled' type="checkbox" v-model="composer_input_disabled" checked>
                    <label for='composer_input_disabled'>Exibir campo de mensagem?</label>
                </div>
                <div class="input-group col s12">
                    <input type="submit" placeholder="+" class="btn">
                </div>
            </div>            
        </form>
        
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                locale: 'default',
                composer_input_disabled: true
            }
        },
        computed: {
            menus() {
                return this.$store.state.menu.listMenus
            }
        },
        mounted() {
            this.$store.dispatch('getMenus')
        }
    }
</script>

<style>
    .margin-botton {
            margin-bottom: 20px;
    }
</style>