<template>
  <div class="top-image">
    <v-container>
      <v-row align="center">
        <v-col class="text-left text-white" md="5">
          <h1 class="display-1 font-weight-thin mb-4">
            おいしいテイクアウト料理を <br />
            スマートに受け取り
          </h1>
          <div class="d-flex">
            <v-text-field
              solo
              label="地域名を入力にて店舗を探す"
              color="#ffd700"
              height="50"
              v-model="serch"
            >
            </v-text-field>
            <router-link 
            :to="{
            name:'shopAdressSerch',
            params:{address:`${serch}`}
            }"
            >
              <v-btn height="50" color="#ffd700" class="serch">検索</v-btn> 
            </router-link>
          </div>

          <router-link
            v-for="(category, index) in ShopCategory"
            :key="category.index"
            :to="{ name: 'ShopList', params: { id: index } }"
            ><v-btn type="button">{{ category.name }}</v-btn>
          </router-link>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    serch:'',
    ShopCategory: [{ name: '和食' }, { name: '洋食' }, { name: '中華' }],
  }),
  methods: {

  },
};
</script>

<style scoped>
a{
  text-decoration: none;
}

.serch{
  color:white!important;
}

.top-image {
  /* background-image: url('../../../../public/storage/top_image2.jpg'); */
  background-image: url('/pickup/images/top_image2.jpg');
  height: 100vh;
  background-size: cover;
  display: flex;
  align-items: center;
}
</style>

<style>

</style>