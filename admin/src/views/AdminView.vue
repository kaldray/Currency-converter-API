<script setup>
import { useRouter } from "vue-router";
import { usePairs } from "@/composable/index.js";
import { deletePairs } from "@/api/index.js";
import { usePairStore } from "@/store/index.js";
import { onMounted } from "vue";

const { pairs, error } = usePairs();
const pairStore = usePairStore();
const router = useRouter();

onMounted(() => {
  pairStore.setPair(null);
});

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

const redirectToUpdatePage = (data) => {
  pairStore.setPair({ ...data });
  router.push("/update");
};
</script>

<template>
  <v-col justify="center" class="text-center">
    <h1>Liste de paires disponible</h1>
  </v-col>
  <v-col>
    <v-btn tag="a" to="/create" color="blue">Ajouter une paire</v-btn>
  </v-col>
  <v-table v-if="pairs" class="mt-5 border">
    <thead class="border">
      <tr>
        <th class="text-center font-weight-bold">ID</th>
        <th class="text-center font-weight-bold">Paires</th>
        <th class="text-center font-weight-bold">Taux de conversion</th>
        <th class="text-center font-weight-bold">Nombre de requête</th>
        <th class="text-center font-weight-bold">Modifier</th>
        <th class="text-center font-weight-bold">Supprimer</th>
      </tr>
    </thead>
    <tbody class="border">
      <tr v-for="p in pairs.data" :key="p.id">
        <td class="text-center">{{ p.id }}</td>
        <td class="text-center">{{ p.to }}-{{ p.from }}</td>
        <td class="text-center">{{ p.conversion_rate }}</td>
        <td class="text-center">{{ p.conversion_number }}</td>
        <td class="text-center">
          <v-btn
            color="yellow"
            text="Modifier"
            type="button"
            @click="redirectToUpdatePage(p)"
          ></v-btn>
        </td>
        <td class="text-center">
          <form @submit.prevent="pairToDelete(p.id)" action="">
            <v-btn color="red" text="Supprimer" type="submit"></v-btn>
          </form>
        </td>
      </tr>
    </tbody>
  </v-table>
  <v-skeleton-loader class="mt-5" v-else></v-skeleton-loader>
  <v-alert v-if="error" type="error" :text="error"></v-alert>
</template>
