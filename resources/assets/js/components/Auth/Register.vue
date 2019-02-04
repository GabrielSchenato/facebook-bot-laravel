<template>
	<div class="row">
		<div class="col s8 push-s2">
			<div class="card">
				<div class="card-content">
					<span class="card-title">Cadastre-se</span>
					<form @submit.prevent="register()">
						<div class="input-field">
							<label for="name">Nome</label>
							<input id="name" type="text" name="name" required autofocus v-model="credentials.name">
						</div>

						<div class="input-field">
							<label for="email">E-Mail</label>
							<input id="email" type="email" name="email" required v-model="credentials.email">
						</div>

						<div class="input-filter">
							<label for="role">Nível de Permissão</label>
							<select class="browser-default" required v-model="credentials.role">
								<optgroup label="Administrador">
									<option value="admin">Admin</option>
								</optgroup>
								<optgroup label="Usuário Padrão">
									<option value="user">Usuário</option>
								</optgroup>
							</select>
						</div>

						<div class="input-field">
							<label for="password">Senha</label>
							<input id="password" type="password" name="password" required v-model="credentials.password">
						</div>

						<div class="input-field">
							<label for="password_confirmation">Confirmação de senha</label>
							<input
								id="password_confirmation"
								type="password"
								name="password_confirmation"
								required
								v-model="credentials.password_confirmation"
							>
						</div>

						<button class="btn" type="submit">Cadastrar</button>
						<a href="#/" class="btn green waves-effect waves-light">
							Voltar
							<i class="material-icons right">arrow_back</i>
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
		data: function() {
			return {
				credentials: {}
			};
		},
		methods: {
			register() {
				if (
					this.credentials.password !==
					this.credentials.password_confirmation
				) {
					swal("Verifique a senha", "As senhas não conferem", "error");
					return;
				}

				this.$auth.register({
					data: this.credentials,
					success: function() {
						swal(
							"Cadastrado com sucesso",
							"Redirecionando para o painel",
							"success",
							{ timer: 1500 }
						);
					},
					error: function(resp) {
						var ul = document.createElement("ul");
						let validation = "";
						if (resp.response.data.errors.name) {
							validation +=
								"<li>" + resp.response.data.errors.name + "</li>";
						}
						if (resp.response.data.errors.email) {
							validation +=
								"<li>" + resp.response.data.errors.email + "</li>";
						}
						if (resp.response.data.errors.password) {
							validation +=
								"<li>" +
								resp.response.data.errors.password +
								"</li>";
						}
						ul.innerHTML = validation;
						swal({
							title: "Falha ao cadastrar!",
							icon: "error",
							content: ul
						});
					},
					redirect: "/"
				});
			}
		}
	};
</script>