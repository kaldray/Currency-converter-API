<script setup>
import Navbar from "./components/NavBar.vue";
</script>

<template>
  <v-layout>
    <header>
      <Navbar />
    </header>
    <v-main>
      <v-container> <router-view /> </v-container>
    </v-main>
  </v-layout>
</template>
