<script setup>
import { useForm } from "@inertiajs/vue3";
import { signInWithEmailAndPassword } from "firebase/auth";
import { auth } from "@/firebase";
import axios from "axios";

const form = useForm({
	email: null,
	password: null
});

const loginWithFirebase = async () => {
	try {
		const cred = await signInWithEmailAndPassword(auth, form.email, form.password);
		const token = await cred.user.getIdToken();

		await axios.post("/auth/firebase", {}, {
			headers: {
				Authorization: `Bearer ${token}`
			}
		});

		window.location.href = "/dashboard";
	} catch (error) {
		console.error("Erro ao fazer login com Firebase:", error);
	}
}
</script>

<template>
	<form @submit.prevent="loginWithFirebase">
		<input type="email" v-model="form.email" class="form-control" />
		<input type="password" v-model="form.password" class="form-control" />
		<button type="submit" value="Login com Firebase" @click="loginWithFirebase">Submeter</button>
	</form>
</template>