<template>
    <div class="row">
        <div class="col s8 push-s2">
            <div class="card">
                <div class="card-content">
                    <span class="card-title">Cadastre-se</span>
                    <form @submit.prevent="register()">
                        <div class="input-field">
                            <label for="name">Nome</label>
                            <input id="name" type="text" name="name" required="" autofocus="" v-model="credentials.name">
                        </div>
                        
                        <div class="input-field">
                            <label for="email">E-Mail</label>
                            <input id="email" type="email" name="email" required="" v-model="credentials.email">
                        </div>

                        <div class="input-field">
                            <label for="password">Senha</label>
                            <input id="password" type="password" name="password" required="" v-model="credentials.password">
                        </div>
                        
                        <div class="input-field">
                            <label for="password_confirmation">Confirmação de senha</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required="" v-model="credentials.password_confirmation">
                        </div>

                        <button class="btn" type="submit">Cadastrar</button>
                        <a href="#/" class="btn green waves-effect waves-light">Voltar <i class="material-icons right">arrow_back</i></a>
                    </form>                    
                </div>
            </div>            
        </div>
    </div>
</template>

<script>
    import swal from 'sweetalert'
    export default {
        data: function() {
            return {
                credentials: {

                }
            }
        },
        methods: {
            register() {
                if(this.credentials.password !== this.credentials.password_confirmation){
                    swal('Verifique a senha', 'As senhas não conferem', 'error')
                    return
                }
                window.axios.post('/register', this.credentials)
                    .then((res) => {
                        if (res.data.status === 'success') {
                            swal('Cadastrado com sucesso', 'Redirecionando para o painel', 'success', {timer: 1500})
                            this.$router.push({
                                path: '/'
                            })

                        } else {
                            var ul = document.createElement("ul");
                            let validation = '';
                            if(res.data.email){
                                validation += '<li>O e-mail já está sendo utilizado!</li>'
                            }
                            if(res.data.password){
                                validation += '<li>A senha deve conter no minímo 6 caracteres!</li>'
                            }
                            ul.innerHTML = validation;
                            swal({
                                title: 'Falha ao cadastrar!',                                
                                icon: 'error',
                                content: ul
                            })
                        }
                    })
                    .catch(() => {
                        swal('Falha ao cadastrar!', 'Erro no servidor', 'error')
                    })
            }
        }
    }
</script>
