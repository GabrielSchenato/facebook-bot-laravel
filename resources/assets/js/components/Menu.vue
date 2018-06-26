<template>
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
        
    </ul>
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
        }
    }
</script>