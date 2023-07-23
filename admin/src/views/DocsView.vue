<template>
  <v-col justify="center" class="text-center"><h1>Documentation</h1></v-col>
  <v-col justify="center" cols="12">
    <h2>Savoir si l'api est disponible</h2>
    <v-code class="text-left">
      HTTP VERB : GET <br />
      http://localhost:8000/api/state <br />
      Retourne : {data: string}
    </v-code>
    <hr />
    <h2>Obtenir la liste de paires disponibles :</h2>
    <v-code class="text-left">
      HTTP VERB : GET <br />
      http://localhost:8000/api/devises/available <br />
      <p>
        Retourne <span class="text-decoration-underline">200</span> :
        <span class="font-weight-bold">
          {data: Array&lt;{ from: string to: string conversion_rate: number }>}</span
        >
      </p>
    </v-code>
    <hr />
    <h2>Convertir une devise</h2>
    <v-code class="text-left">
      HTTP VERB : GET Les données entre {} sont à interpréter
      http://localhost:8000/api/{from}/{amount}/{to} <br />
      <p>
        Retourne <span class="text-decoration-underline">200</span> :
        <span class="font-weight-bold"
          >{data: Array&lt;{ from: string to: string conversion_rate: number }>}</span
        >
      </p>
      <p>
        Retourne <span class="text-decoration-underline">400</span> :
        <span class="font-weight-bold"> {message:string, status:number}</span>
      </p>
    </v-code>
    <h2>Le type des données à envoyer :</h2>
    <v-code>from : string</v-code>
    <v-code>amount : number</v-code>
    <v-code>to : string</v-code>
  </v-col>
</template>

<style scoped>
p,
h2,
hr,
div {
  margin-block-start: 1em;
}
</style>
<script setup></script>
