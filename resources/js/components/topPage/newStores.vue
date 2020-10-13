<template>
  <div class="newStores">
    <div class="title">
      <h1>NEW STORES</h1>
      <p>新着の店舗</p>
    </div>
    <v-row justify="center" v-if="newStores">
      <v-col md="3" cols="12" class="store-box" v-for="store in newStores" :key="store.id">
        <router-link
          :to="{
            name: 'shop',
            params: { id: store.id },
          }"
        >
          <img :src="` ${store.image} `" alt="" />
          <div class="store-text">
            <h3>
              {{ store.name }}
            </h3>
          </div>
        </router-link>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({
    newStores: '',
  }),

  mounted() {
    this.newStoresGet();
  },
  methods: {
    newStoresGet() {
      axios
        .get('/newStoreGet')
        .then((response) => {
          // console.log(response.data);
          this.newStores = response.data;
          console.log(this.newStores[0].image);
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: black !important;
}

.newStores {
  margin-top: 60px;
}

.title {
  text-align: center;
}

.title h1 {
  font-weight: bold;
}

.title p {
  font-size: 14px;
  color: gray;
}

.store-box {
  box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14),
    0px 1px 3px 0px rgba(0, 0, 0, 0.12);
  border-radius: 5px;
  padding: 0;
}

.store-box + .store-box {
  margin-left: 30px;
}

.store-text {
  padding: 16px 16px 24px;
}

.store-text p {
  font-size: 14px;
  color: gray;
}

img {
  width: 100%;
  height: 200px;
  border-radius: 5px 5px 0 0;
}
</style>