<template>
<div class="cart">
    <v-card
    width="100%"
    tile
    >
        <v-list dense>
            <v-subheader class="cart-title">カート情報</v-subheader>
            <v-list-item-group
                color="primary"
            >
                <v-list-item
                v-for="item in cartItems" 
                :key="item.id"
                >
                    <v-list-item-content>
                        <v-list-item-title >
                            {{item.itemName}} / {{item.price}}円 / {{item.quantity}}個
                            <span>
                                
                                <v-btn
                                icon
                                color="error"
                                @click="deleteItemCart(item)"
                                >
                                    <v-icon>mdi-delete</v-icon>
                                </v-btn>
                            </span>
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>

        <p>合計金額： {{cartTotalPrice}}(税込み)</p>
    </v-card>
    
</div>
</template>

<script>
// import { mapState }   from 'vuex';
import { mapGetters } from 'vuex'

export default {
    // computed: mapState(['items']),
    computed:mapGetters(['cartItems','cartTotalPrice']),

    created(){
        console.log(this.cartItems);
        console.log(this.cartTotalPrice);
    },
    methods:{
        deleteItemCart(item){
            this.$store.commit('deleteItemCart',item);
        }
    }
}
</script>

<style scoped>
.cart{
    width:100%;
    text-align: center;
    position: -webkit-sticky;
    top:80px;
    position:sticky;
}

.cart-title{
    font-size:25px;
}

ul{
    margin:0 ;
    /* padding: 0; */
}

</style>