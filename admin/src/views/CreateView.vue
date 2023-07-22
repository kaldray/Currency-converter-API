<script setup>
import PairForm from "@/components/PairForm.vue";
import { addPair } from "@/api/index.js";
import { ref } from "vue";
import { router } from "@/router/index.js";

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
  <PairForm @create-pair="emitCreatePair" :errors="errors" />
</template>
