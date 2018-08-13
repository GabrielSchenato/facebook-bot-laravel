<template>
    <div>
        <nav class="nav-extended">
            <div class="nav-wrapper container-fluid grey darken-4">
                <a href="#/" class="brand-logo center"><i class="material-icons">chat</i> ChatBot</a>
                <a href="#" id="nav-mobile" data-activates="slide-out" class="sidenav-trigger"><i v-if="user.id != undefined" class="material-icons">menu</i></a>
            </div>
        </nav>
        <ul id="slide-out" class="side-nav">
            <li>
                <div class="userView">
                    <div class="background">
                        <img src="img/leaf_background.jpg" alt="">
                    </div>
                    <a><img class="circle" src="https://secure.gravatar.com/avatar/4b0f5245bbffa6fde78b6d62b80923f7" alt=""></a>
                    <a><span class="white-text name">{{ user.name }}</span></a>
                    <a :href="'mailto:' + user.email"><span class="white-text email">{{ user.email }}</span></a>
                </div>
            </li>

            <li><a href="" class="subheader">Bot Manager</a></li>
            <li><a href="#/" class="waves-effect">Postbacks</a></li>
            <li><a href="#/menus" class="waves-effect">Menus</a></li>

            <li><a href="" class="subheader">Conteúdos</a></li>
            <li><a href="#/products" class="waves-effect">Produtos</a></li>
            <li><a href="#/suggestions" class="waves-effect">Sugestões</a></li>

            <li><a href="" class="subheader">Sistema</a></li>
            <li><a href="#" @click.prevent="logout()" class="waves-effect">Logout</a></li>
        </ul>
    </div>
</template>

<script>
    export default {
        computed: {
            user: function () {
                return this.$store.state.user.user
            }
        },
        mounted() {
            $('#nav-mobile').sideNav({
                menuWidth: 300,
                closeOnClick: true
            });
        },
        methods: {
            logout() {
                window.axios.post('/logout')
                    .then((res) => {
                        if (res.data.status === 'success') {
                            swal('Deslogado com sucesso', 'Redirecionando para o painel de login', 'success', {timer: 2000})
                            this.$router.push({
                                path: '/login'
                            })
                            this.$store.dispatch('getCurrentUser')

                        } else {
                            swal('Falha ao deslogar!', 'Tente novamente!', 'error')
                        }
                    })
                    .catch(() => {
                        swal('Falha ao deslogar!', 'Infelizmente isso não foi possível ):', 'error')
                    })
            }
        }
    }
</script>