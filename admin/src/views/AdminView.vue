<script setup>
import { usePairs } from "@/composable/index.js";
import { deletePairs } from "@/api/index.js";

const { pairs, error } = usePairs();

/**
 * Delete the pairs from the DB
 * @param {number}  id
 * @returns {Promise<void>}
 */
const pairToDelete = async (id) => {
  try {
    const response = await deletePairs(id);
    if (response.status === 200) {
      pairs.value.data = pairs.value.data.filter((v) => v.id !== id);
    }
  } catch (err) {
    error.value = "Une erreur est survenue";
    console.log(err);
  }
};
</script>

<template>
  <v-col justify="center" class="text-center">
    <h1>Liste de paires disponible</h1>
  </v-col>
  <v-table v-if="pairs" class="mt-5 border">
    <thead class="border">
      <tr>
        <th class="text-center font-weight-bold">ID</th>
        <th class="text-center font-weight-bold">Paires</th>
        <th class="text-center font-weight-bold">Nombre de requête</th>
        <th class="text-center font-weight-bold">Supprimer</th>
      </tr>
    </thead>
    <tbody class="border">
      <tr v-for="p in pairs.data" :key="p.id">
        <td class="text-center">{{ p.id }}</td>
        <td class="text-center">{{ p.to }}-{{ p.from }}</td>
        <td class="text-center">{{ p.conversion_number }}</td>
        <td class="text-center">
          <form @submit.prevent="pairToDelete(p.id)" action="">
            <v-btn color="red" text="Supprimer" type="submit"></v-btn>
          </form>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-alert v-if="error" type="error" :text="error"></v-alert>
</template>
