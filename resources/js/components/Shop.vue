<template>
  <div>
      <store-image v-bind:store = "storeUser" />
      <v-container>
          <v-row>
              <v-col lg="2" md="3" sm="4" cols="6" class="shop-item-list" v-for="shopitem in shopitems" :key="shopitem.id" style="width:300px; height:350px;">
                <v-img 
                  
                    
                    :src="shopitem.item_image"
                    style="height:auto;"
                    >
                    
                </v-img>
                <div class="shop-item-detail-section" style="text-align:center;">

                    <div class="item-name" >
                        {{ shopitem.item_name }}
                    </div>

                    <div class="item-price" >
                        {{ shopitem.price}}
                    </div>

                    <div class="item-status" >
                        {{ shopitem.item_status}}
                    </div>
                </div>
                <div class="button" style="display:flex; justify-content:center;">
                    <v-btn type="button" @click="selectItem(shopitem)" >
                        追加
                    </v-btn>
                </div>
              </v-col>
                <div class="cart">
                    <tr>
                        <th>商品名</th>
                        <th>値段</th>
                        <th>個数</th>
                    </tr>
                    <tr v-for="SelectedItem in SelectedItems" :key="SelectedItem.name">
                        
                        <td>{{SelectedItem.name}}</td>
                        <td>{{SelectedItem.price}}</td>
                        <td>1</td>
                    </tr>
                </div>

          </v-row>
      </v-container>
  </div>
</template>

<script>
export default {
    data: () => ({
        shopitems: '',
        storeUser: {},
        SelectedItems:{},
    }),
    // created(){
    //     this.selectItem();
    // },
    mounted(){
        this.shopDataGet();
        this.getStoreUser();
    },
    // created(){
    //   this.shopDataGet();
    //   this.getStoreUser();
    // },

    methods:{
        
        shopDataGet(){
            axios.get('/shopDataGet/' + this.$route.params.id)
            .then(response => {
                this.shopitems=response.data;
                console.log(this.shopitems);
            })
            .catch( error => console.log(error));
        },
          getStoreUser(){
                axios.get('/storeImage/'+this.$route.params.id)
                .then(response=>{
                this.storeUser = response.data[0];
                this.storeName = response.data.name;
                // console.log(this.storeUser);
                })
                .catch(error => console.log(error));
         },
         
         selectItem(shopitem){
             let items = {"i":"1"};
             
             items.push({'name':shopitem.name,'price':shopitem.price,})   
             console.log(items);
         }
    }
}
</script>

<style>
.v-image__image{
    height:100% !important;
}
</style>