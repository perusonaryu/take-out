<template>
  <div class="shop-address-serch">
    <Header />
    <v-container>
      <div class="Stores">
        <div class="title">
          <h3>{{ storeSerch }} の検索結果</h3>
          <p v-show="result">
            該当するお店はありません
          </p>
        </div>
        <v-row justify="space-between" v-if="storeList">
          <v-col md="4" cols="12" class="store-box" v-for="store in storeList" :key="store.id">
            <div class="box">
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
            </div>
          </v-col>
        </v-row>
      </div>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    storeList: '',
    storeSerch: '',
    result: false,
  }),
  mounted() {
    this.storeSerch = this.$route.params.address;
    this.shopAdressSerch();
  },
  methods: {
    shopAdressSerch() {
      axios
        .post('/shopAdressSerch', {
          address: this.$route.params.address,
        })
        .then(response => {
          if (response.data.length > 0) {
            console.log(response.data);
            this.storeList = response.data;
          } else {
            this.result = true;
          }
        })
        .catch(error => console.log(error));
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: black !important;
}

.shop-address-serch {
  margin-top: 64px;
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
  height: 320px;
  border-radius: 5px;
  padding: 15px;
}

.box {
  height: 100%;
  box-shadow: 0px 2px 1px -1px rgba(0, 0, 0, 0.2), 0px 1px 1px 0px rgba(0, 0, 0, 0.14),
    0px 1px 3px 0px rgba(0, 0, 0, 0.12);
}

/* .store-box + .store-box {
  margin-left: 30px;
} */

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
