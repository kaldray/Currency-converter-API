<script setup>
import { reactive } from "vue";

const props = defineProps({ pair: Object });
const emit = defineEmits(["updatePair", "createPair"]);
const formState = reactive({
  conversion_number: 7,
  conversion_rate: 3.89,
  from: "CNY",
  id: 9,
  to: "AMD",
  ...props?.pair,
});

function emitEvent() {
  emit("createPair", formState);
  emit("updatePair", formState);
}
</script>

<template>
  <v-row no-gutters justify="center" class="my-5">
    <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
      <h1>Modifier une paire</h1>
    </v-col>
  </v-row>
  <v-form @submit.prevent="emitEvent" validate-on="blur" class="mb-8">
    <v-row no-gutters>
      <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
        <v-text-field
          type="number"
          class="mb-2"
          density="comfortable"
          label="Taux de conversion"
          v-model="formState.conversion_rate"
        />
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Nombre de conversion"
          type="number"
          v-model="formState.conversion_number"
        />
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Devise de base"
          type="text"
          v-model="formState.from"
        />
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Nouvelle devise"
          type="text"
          v-model="formState.to"
        />
        <v-btn type="submit" block color="blue" variant="flat">Modifier</v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>
