<script setup lang="ts">
import { privacyPolicy, termsAndConditions } from '@/routes';

</script>

<template>
	<!--  BEGIN FOOTER  -->
	<footer class="footer footer-transparent d-print-none">
		<div class="container-xl">
			<div class="row text-center align-items-center flex-row-reverse">
				<div class="col-lg-auto ms-lg-auto">
					<nav aria-label="Footer">
						<ul class="list-inline list-inline-dots mb-0">
							<li class="list-inline-item">
								<a :href="termsAndConditions().url" tabindex="-1" class="link-secondary"
									target="_blank">Termos e Condições</a>
							</li>

							<li class="list-inline-item">
								<a :href="privacyPolicy().url" tabindex="-1" class="link-secondary"
									target="_blank">Política de Privacidade</a>
							</li>

							<li class="list-inline-item">
								<a href="https://github.com/sponsors/dorivaldovalentim" target="_blank"
									class="link-secondary" rel="noopener">
									<!-- Download SVG icon from http://tabler.io/icons/icon/heart -->
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
										stroke-linejoin="round" aria-hidden="true" focusable="false"
										class="icon text-pink icon-inline icon-4">
										<path
											d="M19.5 12.572l-7.5 7.428l-7.5 -7.428a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" />
									</svg>
									Ajudar o criador
								</a>
							</li>
						</ul>
					</nav>
				</div>

				<div class="col-12 col-lg-auto mt-3 mt-lg-0">
					<ul class="list-inline list-inline-dots mb-0">
						<li class="list-inline-item">
							Copyright &copy; 2026
							<a href="." class="link-secondary">MoKumbu</a>. Todos os direitos reservados.
						</li>

						<li class="list-inline-item">
							<a href="https://github.com/mokumbu/mokumbu" class="link-secondary" rel="noopener"
								target="_blank">
								v1.0.0
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--  END FOOTER  -->
</template>