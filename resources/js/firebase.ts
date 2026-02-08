import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";

const firebaseConfig = {
	apiKey: import.meta.env.VITE_FIREBASE_API_KEY || '__VITE_FIREBASE_API_KEY__',
	authDomain: import.meta.env.VITE_FIREBASE_AUTH_DOMAIN || '__VITE_FIREBASE_AUTH_DOMAIN__',
	projectId: import.meta.env.VITE_FIREBASE_PROJECT_ID || '__VITE_FIREBASE_PROJECT_ID__',
	storageBucket: import.meta.env.VITE_FIREBASE_STORAGE_BUCKET || '__VITE_FIREBASE_STORAGE_BUCKET__',
	messagingSenderId: import.meta.env.VITE_FIREBASE_MESSAGING_SENDER_ID || '__VITE_FIREBASE_MESSAGING_SENDER_ID__',
	appId: import.meta.env.VITE_FIREBASE_APP_ID || '__VITE_FIREBASE_APP_ID__',
};

const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);
