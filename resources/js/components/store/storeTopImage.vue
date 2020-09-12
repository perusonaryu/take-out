<template>
  <v-parallax
    dark
    src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
    height= "300"
  >
    <v-row
      align="center"
      justify="center"
    >
      <v-col class="text-left" cols="12">
        <h1 class="display-1 font-weight-thin mb-4"> {{ storeName }} </h1>
        <h4 class="subheading">Build your application today!</h4>
      </v-col>
    </v-row>
  </v-parallax>
</template>

<script>
export default {
    props:['storeName'],
    data: () => ({
      storeUser: {},

      
    }),
}
</script>

<style>

</style>