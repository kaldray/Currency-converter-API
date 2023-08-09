<script setup>
import { reactive, watch } from "vue";
import { usePairs, useUnusedDevises } from "@/composable/index.js";

const { devise, error } = useUnusedDevises();
const { pairs } = usePairs();
const props = defineProps({ errors: Object || undefined });
const emit = defineEmits(["createPair"]);
const selectDevise = reactive({ from: [], to: [] });
const formState = reactive({
  conversion_number: null,
  conversion_rate: null,
  from: "",
  to: "",
});

watch(devise, async (newDevise) => {
  selectDevise.from = newDevise.data.map((d) => d.name);
  selectDevise.to = newDevise.data.map((d) => d.name);
});

function emitEvent() {
  emit("createPair", formState);
}
</script>

<template>
  <v-row no-gutters justify="center" class="my-5">
    <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
      <h1>Créer une paire</h1>
    </v-col>
  </v-row>
  <v-row align="baseline" justify="center" class="w-100 ga-3">
    <v-col sm="4" cols="12">
      <v-table v-if="pairs" class="mt-5 border">
        <thead class="border">
          <tr>
            <th class="text-center font-weight-bold">ID</th>
            <th class="text-center font-weight-bold">Paires</th>
          </tr>
        </thead>
        <tbody class="border">
          <tr v-for="p in pairs.data" :key="p.id">
            <td class="text-center">{{ p.id }}</td>
            <td class="text-center">{{ p.from }}-{{ p.to }}</td>
          </tr>
        </tbody>
      </v-table>
      <v-skeleton-loader v-else type="table-thead, table-tbody"></v-skeleton-loader>
    </v-col>
    <v-col cols="12" sm="6" md="6">
      <v-form @submit.prevent="emitEvent" class="my-8 w-100">
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
        <v-select
          class="mb-2"
          v-if="selectDevise"
          :items="selectDevise.from"
          density="comfortable"
          label="Devise de base"
          type="text"
          v-model="formState.from"
        />
        <v-skeleton-loader v-else />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors?.from"
          :text="props.errors?.errors?.from[0]"
          type="warning"
        ></v-alert>
        <v-select
          class="mb-2"
          v-if="selectDevise"
          :items="selectDevise.to"
          density="comfortable"
          label="Nouvelle devise"
          type="text"
          :readonly="props?.pair !== undefined"
          v-model="formState.to"
        />
        <v-alert
          class="mb-5 text-center"
          density="compact"
          v-if="props.errors?.errors?.to"
          :text="props.errors?.errors?.to[0]"
          type="warning"
        ></v-alert>
        <v-btn type="submit" block color="blue" variant="flat">AJouter</v-btn>
      </v-form>
    </v-col>
  </v-row>
</template>
