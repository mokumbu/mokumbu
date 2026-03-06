<script setup lang="ts">
import { browserLocalPersistence, FacebookAuthProvider, setPersistence, signInWithPopup } from "firebase/auth";
import axios from "axios";
import { auth } from "@/firebase";

const loginWithFacebook = async () => {
	try {
		await setPersistence(auth, browserLocalPersistence);

		const provider = new FacebookAuthProvider();
		const result = await signInWithPopup(auth, provider);

		const token = await result.user.getIdToken();

		await axios.post(
			"/auth/firebase",
			{ remember: true },
			{
				headers: {
					Authorization: `Bearer ${token}`,
					Accept: "application/json"
				}
			}
		);

		window.location.href = "/dashboard";
	} catch (e) {
		console.error("Erro no login social:", e);
	}
};

</script>

<template>
	<a @click.prevent="loginWithFacebook" class="btn btn-icon btn-facebook"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-facebook -->
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
			stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
			<path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3">
			</path>
		</svg>
	</a>
</template>