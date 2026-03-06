<script setup lang="ts">
import { browserLocalPersistence, GoogleAuthProvider, setPersistence, signInWithPopup } from "firebase/auth";
import axios from "axios";
import { auth } from "@/firebase";

const loginWithGoogle = async () => {
	try {
		await setPersistence(auth, browserLocalPersistence);

		const provider = new GoogleAuthProvider();
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
	<a @click.prevent="loginWithGoogle" class="btn btn-icon btn-google"><!-- Download SVG icon from http://tabler.io/icons/icon/brand-google -->
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
			stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
			<path d="M20.945 11a9 9 0 1 1 -3.284 -5.997l-2.655 2.392a5.5 5.5 0 1 0 2.119 6.605h-4.125v-3h7.945z">
			</path>
		</svg>
	</a>
</template>