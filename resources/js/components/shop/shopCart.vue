<template>
<div class="cart">
    <ul v-for="item in cartItems" :key="item.id">
        <li>
            {{item.itemName}} / {{item.price}}円 / {{item.quantity}}個
            <span>
                <v-btn color="error" text @click="deleteItemCart(item)">削除</v-btn>
            </span>
        </li>
    </ul>
    <p>合計金額： {{cartTotalPrice}}(税込み)</p>
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
    width:50%;
    border:2px solid gray;
    padding:40px 0;
    margin:0 auto;
    text-align: center;
}

ul{
    margin:0 ;
    /* padding: 0; */
}

</style>