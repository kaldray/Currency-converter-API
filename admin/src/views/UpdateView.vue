<script setup>
import { ref } from "vue";
import { modifyPair } from "@/api/index.js";
import PairForm from "@/components/PairUpdateForm.vue";
import { router } from "@/router/index.js";

const errors = ref(null);

async function emitUpdatePair(pair) {
  try {
    const response = await modifyPair(pair);
    if (response.status === 200) {
      router.push("/list");
    }
  } catch (err) {
    errors.value = err;
  }
}
</script>

<template>
  <PairForm @update-pair="emitUpdatePair" :errors="errors" />
</template>
