<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Menu from '@/components/Menu.vue';
import Footer from '@/components/Footer.vue';

interface Props {
	title: string;
}

defineProps<Props>();
</script>

<template>
	<Head :title="title"></Head>

	<a href="#content" class="visually-hidden skip-link">Skip to main content</a>

	<div class="page">
		<Menu />

		<div class="page-wrapper">
			<slot name="header"></slot>

			<main id="content" class="page-body">
				<slot name="body"></slot>
			</main>
			
			<Footer />
		</div>

		<slot name="extra"></slot>
	</div>
</template>