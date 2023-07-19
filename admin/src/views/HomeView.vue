<script setup>
import LoginForm from "@/components/LoginForm.vue";
import { useAuthStore } from "@/store";

const authStore = useAuthStore();

/**
 *
 * @param {{ email:string,password:string }} creditials
 */
const emitLogin = async (creditials) => {
  authStore.logIn(creditials);
};
</script>

<template>
  <LoginForm @login="emitLogin" />
</template>
