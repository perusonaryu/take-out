<template>
  <v-parallax
    dark
    src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg"
    height="500"
  >
  <v-container>
    <v-row
      align="center"

    >
      <v-col class="text-left" md="5">
        <h1 class="display-1 font-weight-thin mb-4">
            おいしいテイクアウト料理を <br>
            スマートに受け取り
        </h1>
        <v-text-field
            v-model="serchMessage"
            label="地域名を入力似て店舗を探す"
            type="text"
            color="white white-2"
            light
        >
            <template v-slot:append>
            <v-btn @click="serch">検索</v-btn>
            </template>
        </v-text-field>
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
  </v-parallax>
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
.theme--light.v-text-field>.v-input__control>.v-input__slot:before {
    border-color: white;
}

.v-text-field>.v-input__control>.v-input__slot:after {
    border-color: white;
}

.theme--light.v-input, .theme--light.v-input input, .theme--light.v-input textarea {
    color: white;
}
</style>