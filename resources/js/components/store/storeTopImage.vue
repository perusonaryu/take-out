<template>
  <v-img
    :src="store.image"
    width="100%"
    height="500"
    style=" border-radius: 15px;box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.3);"
  >
    <v-row align="center" class="h-100 mp-0">
      <v-col class="text-left  image-text d-flex align-center" md="4">
        <div>
          <h3 style="color:black;font-weight: bold;">{{ store.name }}</h3>
        </div>
      </v-col>
    </v-row>
  </v-img>
</template>

<script>
export default {
  props: ['store'],
  data: () => ({
    // name:"",
    // image:"",
  }),
  //  mounted(){
  //     this.name=this.store.name;
  //     this.image=this.store.image;
  //     console.log(this.store);

  // },
};
</script>

<style scoped>
img {
  background-size: cover;
}

.image-text {
  background-color: #fff;
  border-radius: 15px;
  height: 150px;
  padding: 10px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.3);
}

/* .image-text h3{
  margin: 0;
} */

.mp-0 {
  margin: 0;
  padding: 0;
}
</style>

<style>
.v-image__image {
  height: 500px;
  width: 100%;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.2);
}
</style>
