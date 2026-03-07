<script setup lang="ts">
import Layout from '@/layouts/Dashboard.vue';
import { useForm, usePage } from '@inertiajs/vue3'
import { computed } from 'vue';

const page = usePage()

const form = useForm({
	name: page.props.auth.user.name ?? '',
	username: page.props.auth.user.username ?? '',
	email: page.props.auth.user.email ?? '',

	phone_number: page.props.auth.user.profile?.phone_number ?? '',
	birthdate: page.props.auth.user.profile?.birthdate ?? '',
	gender: page.props.auth.user.profile?.gender ?? '',
	address: page.props.auth.user.profile?.address ?? '',
});

const auth = computed(() => page.props.auth);
</script>

<template>
	<Layout title="Perfil">
		<template #header>
			<!-- BEGIN PAGE HEADER -->
			<div class="page-header d-print-none">
				<div class="container-xl">
					<div class="row g-2 align-items-center">
						<div class="col">
							<!-- Page pre-title -->
							<div class="page-pretitle">MoKumbu</div>
							<h1 class="page-title">Perfil de utilizador</h1>
						</div>
					</div>
				</div>
			</div>
			<!-- END PAGE HEADER -->
		</template>

		<template #body>
			<div class="container-xl">
				<div class="card">
					<div class="row g-0">
						<div class="col-12 col-md-3 border-end">
							<div class="card-body">
								<h4 class="subheader">Geral</h4>
								<div class="list-group list-group-transparent">
									<a href="./settings.html"
										class="list-group-item list-group-item-action d-flex align-items-center active">Detalhes
										pessoais</a>
									<a href="#"
										class="list-group-item list-group-item-action d-flex align-items-center">Redes
										sociais</a>
								</div>

								<h4 class="subheader mt-4">Experiência</h4>
								<div class="list-group list-group-transparent">
									<a href="#" class="list-group-item list-group-item-action">Deixe seu comentário</a>
								</div>
							</div>
						</div>

						<div class="col-12 col-md-9 d-flex flex-column">
							<div class="card-body">
								<h2 class="mb-4">Detalhes pessoais</h2>
								<h3 class="card-title mt-4">Foto de perfil</h3>
								<div class="row align-items-center">
									<div class="col-auto">
										<span v-if="auth.user.profile?.profile_picture" class="avatar avatar-xl"
											:style="{ backgroundImage: `url(${auth.user.profile.profile_picture})` }"></span>

										<span v-else class="avatar avatar-xl">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
												viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round"
												class="icon avatar-icon icon-2">
												<path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path>
												<path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
											</svg>
										</span>
									</div>

									<div class="col-auto">
										<a href="#" class="btn btn-1">
											Actualizar
										</a>
									</div>
								</div>
								
								<h3 class="card-title mt-4">Detalhes</h3>
								<div class="row g-3">
									<div class="col-12 col-md-4">
										<div class="form-label">Nome de utilizador</div>
										<input v-model="form.username" type="text" class="form-control" />
									</div>

									<div class="col-12 col-md-5">
										<div class="form-label">Nome</div>
										<input v-model="form.name" type="text" class="form-control" />
									</div>

									<div class="col-12 col-md-3">
										<div class="form-label">Data de nascimento</div>
										<input v-model="form.birthdate" type="date" class="form-control" />
									</div>

									<div class="col-12 col-md-6">
										<div class="col-12 mb-2">
											<div class="form-label">Telefone</div>
											<input v-model="form.phone_number" type="text" class="form-control" />
										</div>

										<div class="col-12 mb-2">
											<div class="form-label">Gênero</div>
											<select v-model="form.gender" class="form-select">
												<option value="male">Masculino</option>
												<option value="female">Feminino</option>
											</select>
										</div>
									</div>

									<div class="col-12 col-md-6">
										<label class="form-label">Endereço</label>
										<textarea v-model="form.address" rows="5" class="form-control"></textarea>
									</div>
								</div>

								<h3 class="card-title mt-4">E-mail</h3>
								<div>
									<div class="row g-2">
										<div class="col-auto">
											<input v-model="form.email" type="text" class="form-control w-auto" />
										</div>

										<div class="col-auto">
											<a href="#" class="btn btn-1">
												Actualizar
											</a>
										</div>
									</div>
								</div>

								<h3 class="card-title mt-4">Palavra passe</h3>
								<div>
									<a href="#" class="btn btn-1">
										Actualizar palavra passe
									</a>
								</div>
							</div>

							<div class="card-footer bg-transparent mt-auto">
								<div class="btn-list justify-content-end">
									<a href="#" class="btn btn-1">
										Cancelar
									</a>

									<a href="#" class="btn btn-primary btn-2">
										Submeter
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</template>
	</Layout>
</template>