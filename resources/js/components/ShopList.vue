<template>
<div>
<h1 style="text-align:center;">検索結果</h1>
  <v-row justify="center" align="center">
      
      
      <v-col md="3" v-for="shop in ShopList" :key="shop.id" >
            <div class="card" style="width: 18rem;height:15rem;">
                <img
                :src="`${shop.image}`"
                width="100%"
                height="100%"
                style="object-fit:cover;"
                >
                <div class="card-body">
                    <h6 class="card-title">{{shop.name}} </h6>
                    <p class="card-text"> {{shop.category}}</p>
                    <p class="card-text"> {{shop.address}}</p>
                </div>
            </div>
        </v-col>
    </v-row>
    </div>
</template>

<script>
export default {
    // props:{
    //     category:String
    // },
    data(){
        return{
            ShopList:'',
        }
    },
    mounted(){
        this.shopList();
    },
    methods:{
        shopList(){
            axios.get('/shopListGet/'+this.$route.params.id)
            .then(response => {
                this.ShopList=response.data;
                console.log(response.data);
            })
            .catch( error => console.log(error));
        }
    }
}
</script>

<style>

</style>