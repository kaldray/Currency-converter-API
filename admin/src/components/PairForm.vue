<script setup>
import { reactive } from "vue";

const props = defineProps({ pair: Object, errors: Object || undefined });
const emit = defineEmits(["updatePair", "createPair"]);
const formState = reactive({
  conversion_number: null,
  conversion_rate: null,
  from: "",
  to: "",
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
      <h1 v-if="props?.pair">Modifier une paire</h1>
      <h1 v-else>Créer une paire</h1>
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
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors.conversion_rate"
          :text="props.errors?.errors.conversion_rate[0]"
          type="warning"
        ></v-alert>
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Nombre de conversion"
          type="number"
          v-model="formState.conversion_number"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors.conversion_number"
          :text="props.errors?.errors.conversion_number[0]"
          type="warning"
        ></v-alert>
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Devise de base"
          type="text"
          :readonly="props?.pair !== undefined"
          v-model="formState.from"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors.from"
          :text="props.errors?.errors.from[0]"
          type="warning"
        ></v-alert>
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Nouvelle devise"
          type="text"
          :readonly="props?.pair !== undefined"
          v-model="formState.to"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors.to"
          :text="props.errors?.errors.to[0]"
          type="warning"
        ></v-alert>
        <v-btn type="submit" block color="blue" variant="flat" v-if="props?.pair">Modifier</v-btn>
        <v-btn type="submit" block color="blue" variant="flat" v-else>AJouter</v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>
