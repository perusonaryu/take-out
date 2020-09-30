<template>
  <div>
      <store-image v-bind:store = "storeUser" />
      <!-- <v-container>
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
      </v-container> -->
    <!-- <v-img
        :src= "` ${store.image} `"
        width="100%"
        height="300"
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
    </v-img> -->

    <v-row justify="center" align="center">
        <v-col md="3" v-for="item in shopData" :key="item.id" class="d-flex justify-center">

            <div class="card" style="width: 18rem;" data-toggle="modal" :data-target="`#itemModal${item.id}`">
                <img
                :src="`${item.item_image}`"
                width="100%"
                >
                <div class="card-body">
                    <h6 class="card-title">{{item.item_name}} </h6>
                    <p class="card-text"> {{item.price}}円</p>
                </div>
            </div>

            <div class="modal fade" :id="`itemModal${item.id}`" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <img
                            :src="`${item.item_image}`"
                            width="100%"
                            >
                            <button type="button" class="close d-flex align-center justify-center" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5 class="modal-title" id="exampleModalLabel"> {{item.item_name}} </h5>
                            <p>
                                人気商品！！大きな螺旋状のショートパスタと、チキンを白ワインと香味野菜で煮込んだソースを合わせました。
                                トスカーナ産オリーブオイル・バーニャカウダ・モルタデッラハム・フォカッチャが付きます。
                            </p>
                        </div>
                        <div class="quantity ">
                            <v-btn color="success" text @click="addItemCart(item)">
                                カートに追加する
                            </v-btn>
                        </div>
                    </div>
                </div>
            </div>
        </v-col>
        <router-link to="/Confirm">次へ</router-link>
    </v-row>

    <shop-cart />

  </div>
</template>

<script>
export default {
    data: () => ({
        shopitems: '',
        storeUser: {},
        SelectedItems:{},
        shopData: '',
        store:'',
    }),
    // created(){
    //     this.selectItem();
    // },
    mounted(){
    },
    created(){
        this.shopDataGet();
        this.getStoreUser();
        // this.storeDataGet();
    },
    // created(){
    //   this.shopDataGet();
    //   this.getStoreUser();
    // },

    methods:{
        
        shopDataGet(){
            axios.get('/shopDataGet/' + this.$route.params.id)
            .then(response => {
                this.shopData=response.data;
                console.log(this.shopData);
            })
            .catch( error => console.log(error));
        },
          getStoreUser(){
                axios.get('/storeImage/'+this.$route.params.id)
                .then(response=>{
                this.storeUser = response.data[0];
                this.storeName = response.data.name;
                console.log(this.storeUser);
                })
                .catch(error => console.log(error));
         },
         
        //  selectItem(shopitem){
        //      let items = {"i":"1"};
             
        //      items.push({'name':shopitem.name,'price':shopitem.price,})   
        //      console.log(items);
        //  }
        //         // console.log(response.data);
        //         this.shopData = response.data;
        //     })
        //     .catch( error => console.log(error));
        // },

        // storeDataGet(){
        //     axios.get('/storeGet/' + this.$route.params.id)
        //     .then(response => {
        //         console.log(response.data);
        //         this.store = response.data; 
        //     })
        //     .catch(error => console.log(error));
        // }
    // },
        storeDataGet(){
            axios.get('/storeGet/' + this.$route.params.id)
            .then(response => {
                console.log(response.data);
                this.store = response.data; 
            })
            .catch(error => console.log(error));
        },
        addItemCart(item){
            this.$store.dispatch('addItemCart',item);
        }
        

    }
    // computed: mapGetters(['cartItems']),
}


</script>



<style scoped>
.modal-header{
    padding:0;
    position: relative;
}

.close{
    position:absolute;
    right:20px;
    top:20px;
    width:50px;
    height:50px;
    background: white;
    border-radius: 50%;
}

.close span{
    padding:0px 0px 3px;
}


</style>