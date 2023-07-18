<script setup>
import { computed, unref } from "vue";
import { useDisplay } from "vuetify";

const display = useDisplay();
const isSmartphone = computed(() => {
  return unref(display.xs);
});

const routes = [{ to: "/", text: "Accueil" }];
</script>

<template>
  <v-app-bar
    color="blue"
    scroll-behavior="elevate"
  >
    <v-app-bar-title>Currency</v-app-bar-title>
    <!-- Menu Mobile -->
    <v-menu v-if="isSmartphone">
      <template v-slot:activator="{ props }">
        <v-app-bar-nav-icon v-bind="props" />
      </template>

      <v-list>
        <v-list-item
          v-for="{ to, text } in routes"
          :to="to"
          :key="to"
        >
          <v-list-item-title>{{ text }}</v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

    <!-- Menu Desktop -->
    <v-toolbar-items v-else>
      <template
        v-for="{ to, text } in routes"
        :key="to"
      >
        <v-btn
          :to="to"
          variant="text"
          >{{ text }}</v-btn
        >
        <v-divider vertical></v-divider>
      </template>
    </v-toolbar-items>
  </v-app-bar>
</template>
