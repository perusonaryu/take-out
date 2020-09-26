<template>
  <v-img
    :src= "` ${store.image} `"
    width="100%"
    height="500"
  >
  
    <v-row
      align="center"
      justify="center"
      class="h-100"
    >
      <v-col class="text-left" md="6">
        <h1 class="display-1 font-weight-thin mb-4"> {{ store.name }} </h1>
      </v-col>
    </v-row>
  </v-img>
</template>

<script>
export default {
    props:['store'],
    data: () => ({
      storeUser: {},

      
    }),
}
</script>

<style scoped>
img{
  background-size: cover;
}



</style>

<style>
.v-image__image{
  height:500px;
  width:100%;
  object-fit:cover;
}
</style>