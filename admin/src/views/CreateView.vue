<script setup>
import { addPair } from "@/api/index.js";
import { ref } from "vue";
import { router } from "@/router/index.js";
import PairCreateForm from "@/components/PairCreateForm.vue";

const errors = ref(null);

const emitCreatePair = async (pair) => {
  try {
    const response = await addPair(pair);
    if (response.status === 200) {
      router.push("/list");
    }
  } catch (err) {
    errors.value = err;
  }
};
</script>

<template>
  <PairCreateForm @create-pair="emitCreatePair" :errors="errors" />
</template>
