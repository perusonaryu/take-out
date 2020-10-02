<template>
    <div class="shop">
        <Header />
        <v-row class="mp-0">
            <v-col md="9" class="shop-item"> 
                <store-image v-bind:store = "storeUser" />
                <v-container>
                    <v-row justify="center" align="center" class="mp-0">
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
                                        <div class="quantity">
                                            <v-btn color="success" text @click="addItemCart(item)" data-dismiss="modal">
                                                カートに追加する
                                            </v-btn>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </v-col>
                        
                    </v-row>

                </v-container>
            </v-col>

            <v-col md="3" class="cart-item">
                <shop-cart />

                
            </v-col>
        </v-row>
       

    

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


    methods:{
        
        shopDataGet(){
            axios.get('/shopDataGet/' + this.$route.params.id)
            .then(response => {
                this.shopData=response.data;
                // console.log(this.shopData);
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

        storeDataGet(){
            axios.get('/storeGet/' + this.$route.params.id)
            .then(response => {
                // console.log(response.data);
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

.card{
    cursor:pointer;
}

.shop{
    margin-top: 64px;
}

.mp-0{
    margin: 0;
    padding: 0;
}

.shop-item{
    padding:0;
}

.cart-item{
    padding:0;
    border-left:solid 1px gray;
    position: relative;
}

.paid-btn{
    position: absolute;
    bottom:20px;
}


</style>