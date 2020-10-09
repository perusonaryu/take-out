<template>
  <div class="cart">
    <v-card width="100%" tile>
      <v-list dense>
        <v-subheader class="cart-title">ご注文情報</v-subheader>
        <v-list-item-group color="primary">
          <v-list-item v-for="item in cartItems" :key="item.id">
            <v-list-item-content>
              <v-list-item-title>
                {{ item.itemName }} / {{ item.price }}円 / {{ item.quantity }}個
                <span>
                  <v-btn icon color="error" @click="deleteItemCart(item)">
                    <v-icon>mdi-delete</v-icon>
                  </v-btn>
                </span>
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-item-group>
      </v-list>

      <p>合計金額： {{ cartTotalPrice }}(税込み)</p>
    </v-card>

      <v-btn v-bind:disabled="cartEmpty" @click="cofirmPaidMove">
        注文する
      </v-btn>
  </div>
</template>

<script>
// import { mapState }   from 'vuex';

import { mapGetters } from 'vuex';

export default {
  data: () => ({
    
  }),
  props:['cartEmpty'],
  // computed: mapState(['items']),
  computed: mapGetters(['cartItems', 'cartTotalPrice']),

  created() {
    // console.log(this.cartItems);
  },
  methods: {
    deleteItemCart(item) {
      this.$store.commit('deleteItemCart', item);
      this.$emit('cart-empty-check');
    },

    cartEmptyCheck() {
      if(this.cartItems.length > 0){
        this.cartEmpty = false
      }
    },

    cofirmPaidMove(){
      this.$router.push({ name: "Confirm"})
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}

.cart {
  width: 100%;
  text-align: center;
  position: -webkit-sticky;
  top: 20%;
  position: sticky;

  /* height:100vh; */
}

.cart-title {
  font-size: 25px;
}

ul {
  margin: 0;
  /* padding: 0; */
}

@media (max-width: 670px) {
  .cart {
    position: fixed;
    z-index: 2;
    top: 0;
    left: 0;
    color: #fff;
    background: white;
    text-align: center;
    width: 100%;
    height: 100vh;
    margin-top: 64px;
  }
}
</style>