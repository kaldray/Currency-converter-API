<script setup>
import { usePairs } from "@/composable/index.js";
const { pairs, error } = usePairs();
</script>

<template>
  <v-col justify="center" class="text-center">
    <h1>Liste de paires disponible</h1>
  </v-col>

  <v-table v-if="pairs" class="mt-5 border">
    <thead class="border">
      <tr>
        <th class="text-center font-weight-bold">Paires</th>
        <th class="text-center font-weight-bold">Nombre de requête</th>
        <th class="text-center font-weight-bold">Supprimer</th>
      </tr>
    </thead>
    <tbody class="border">
      <tr v-for="p in pairs.data">
        <td class="text-center">{{ p.to }}-{{ p.from }}</td>
        <td class="text-center">{{ p.conversion_number }}</td>
        <td class="text-center">
          <v-btn color="red" text="Supprimer"></v-btn>
        </td>
      </tr>
    </tbody>
  </v-table>
</template>
