<template>
<div class="cart">
    <ul v-for="item in cartItems" :key="item.id">
        <li>
            {{item.itemName}} / {{item.price}}円 / {{item.quantity}}個
        </li>
    </ul>
</div>
</template>

<script>
// import { mapState }   from 'vuex';
import { mapGetters } from 'vuex'

export default {
    // computed: mapState(['items']),
    computed: mapGetters(['cartItems']),

    created(){

    }
}
</script>

<style scoped>
.cart{
    width:50%;
    border:2px solid gray;
    padding:40px 0;
    margin:0 auto;
}

ul{
    margin:0 ;
    /* padding: 0; */
}

</style>