<template>
    <div class="row">
        <div class="col s8 push-s2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Acessar</span>
                    <form @submit.prevent="login()">
                        <div class="input-field">
                            <label for="email">E-Mail</label>
                            <input id="email" type="email" name="email" required autofocus v-model="credentials.email">
                        </div>

                        <div class="input-field">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="password" required v-model="credentials.password">
                        </div>

                        <div>
                            <input id="remember" type="checkbox" name="remember" v-model="credentials.remember">
                            <label for="remember">Lembrar de mim</label>
                        </div>

                        <hr>
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Login
                            <i class="material-icons right">exit_to_app</i>
                        </button>

                        <a href="#/register" class="btn green waves-effect waves-light">
                            Cadastre-se
                            <i class="material-icons right">person_add</i>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import swal from "sweetalert";
    export default {
        data: function () {
            return {
                credentials: {}
            };
        },
        methods: {
            login() {
                this.$auth.login({
                    data: this.credentials,
                    success: function () { },
                    error: function () {
                        swal("Falha ao autenticar!", "Usuário ou senha inválidos", "error");
                    },
                    rememberMe: true,
                    redirect: "/",
                    fetchUser: true
                });
            }
        }
    };
</script>