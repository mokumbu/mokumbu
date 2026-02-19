<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import Menu from '@/components/Menu.vue';
import Footer from '@/components/Footer.vue';
import ThemeSettings from '@/components/ThemeSettings.vue';

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
			<slot name="header" />

			<main id="content" class="page-body">
				<slot name="body" />
			</main>
			
			<Footer />
		</div>

		<slot name="extra" />
	</div>

	<ThemeSettings />
</template>