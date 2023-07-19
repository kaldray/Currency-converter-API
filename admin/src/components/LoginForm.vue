<script setup>
import { reactive, ref } from "vue";

const formState = ref();
const formUser = reactive({
  email: "",
  password: "",
});

const rules = {
  /**
   * @param {string} value
   */
  required: (value) => value.trim() !== "" || "Ce champs est requis",
};

const emit = defineEmits(["login"]);

function submitForm() {
  if (formState.value) {
    emit("login", formUser);
  }
}
</script>

<template>
  <v-row no-gutters justify="center" class="my-5">
    <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
      <h1>Se connecter</h1>
    </v-col>
  </v-row>
  <v-form
    @submit.prevent="submitForm"
    v-model="formState"
    validate-on="blur"
    class="mb-8"
  >
    <v-row no-gutters>
      <v-col cols="12" sm="8" offset-sm="2" md="6" offset-md="3">
        <!-- Email -->
        <v-text-field
          type="email"
          class="mb-2"
          density="comfortable"
          label="Email"
          v-model="formUser.email"
          :rules="[rules.required]"
        />

        <!-- Prénom -->
        <v-text-field
          class="mb-2"
          density="comfortable"
          label="Mot de passe"
          type="password"
          v-model="formUser.password"
          :rules="[rules.required]"
        />

        <!-- VALIDATION -->
        <v-btn type="submit" block color="blue" variant="flat"> Envoyer </v-btn>
      </v-col>
    </v-row>
  </v-form>
</template>
