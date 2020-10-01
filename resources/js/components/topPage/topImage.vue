<template>
  <div
  class="top-image"
  >
  <v-container>
    <v-row
      align="center"
    >
      <v-col class="text-left text-white" md="5">
        <h1 class="display-1 font-weight-thin mb-4">
            おいしいテイクアウト料理を <br>
            スマートに受け取り
        </h1>
        <v-text-field
          solo
          label="地域名を入力にて店舗を探す"
          append-icon="mdi-map-marker"
          color="#ffd700"
          height="60"
        ></v-text-field>
        <router-link 
        v-for="(category,index) in ShopCategory" :key="category.index"
           :to="{ name: 'ShopList',
            params: { id:  index}
            }"
            ><v-btn type="button" >{{category.name}}</v-btn>
        </router-link>
      </v-col>
    </v-row>

  </v-container>
  </div>
</template>

<script>
export default {
  data: () => ({
    serchMessage:'',
    ShopCategory:[{'name':'和食'},{'name':'洋食'},{'name':'中華'}],
  }),
  methods:{
    serch(){
      axios.get('/' + this.serchMessage)
      .then(response => {
        console.log('ok');
      })
      .catch(error => console.log(error))
    }
  }
}

</script>

<style scoped>


.top-image{
  background-image: url("../../../../public/storage/top_image2.jpg");
  height:100vh;
  background-size: cover;
  display: flex;
  align-items: center;
}
</style>

<style>
/* .theme--light.v-label{
  color:white;
}

.theme--light.v-text-field>.v-input__control>.v-input__slot:before{
  border-color:white;
} */
</style>