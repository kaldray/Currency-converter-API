<script setup>
import { onBeforeUnmount, reactive } from "vue";
import { usePairStore } from "@/store/index.js";

const pairStore = usePairStore();
const props = defineProps({ errors: Object || undefined });
const emit = defineEmits(["updatePair"]);
const formState = reactive({
  conversion_number: null,
  conversion_rate: null,
  from: "",
  to: "",
  ...pairStore?.pair,
});

onBeforeUnmount(() => {
  pairStore.setPair(null);
});

function emitEvent() {
  emit("updatePair", formState);
}
</script>

<template>
  <v-row no-gutters justify="center" class="my-5">
    <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
      <h1>Modifier une paire</h1>
    </v-col>
  </v-row>
  <v-form @submit.prevent="emitEvent" class="mb-8">
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
          v-if="props.errors?.errors?.conversion_rate"
          :text="props.errors?.errors?.conversion_rate[0]"
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
          v-if="props.errors?.errors?.conversion_number"
          :text="props.errors?.errors?.conversion_number[0]"
          type="warning"
        ></v-alert>
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Devise de base"
          type="text"
          :readonly="true"
          v-model="formState.from"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors?.from"
          :text="props.errors?.errors?.from[0]"
          type="warning"
        ></v-alert>
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Nouvelle devise"
          type="text"
          :readonly="true"
          v-model="formState.to"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors?.to"
          :text="props.errors?.errors?.to[0]"
          type="warning"
        ></v-alert>
        <v-btn type="submit" block color="blue" variant="flat">Modifier</v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>
