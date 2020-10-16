<template>
  <div class="shop">
    <Header>
      <!-- <router-link to="/login">
        <v-btn class="btn-font" color="white" outlined> ログイン </v-btn>
      </router-link> -->
      <v-btn icon color="white" x-large class="cart-btn" @click="cartBtn">
        <v-icon>mdi-cart</v-icon>
      </v-btn>
    </Header>
    <v-row class="mp-0">
      <v-col md="9" class="shop-item">
        <store-image v-bind:store="storeUser" />
        <v-container>
          <v-row  align="center" class="mp-0">
            <v-col md="4" v-for="item in shopData" :key="item.id" class="d-flex justify-center">
              <div
                class="card"
                style="width: 300px"
                data-toggle="modal"
                :data-target="`#itemModal${item.id}`"
              >
                <div class="item-image">
                  <img :src="`${item.item_image}`" width="100%" />
                </div>
                <div class="card-body">
                  <h6 class="card-title">{{ item.item_name }}</h6>
                  <p class="card-text">{{ item.price }}円</p>
                </div>
              </div>

              <div
                class="modal fade"
                :id="`itemModal${item.id}`"
                tabindex="-1"
                role="dialog"
                aria-labelledby="exampleModalLabel"
                aria-hidden="true"
              >
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <img :src="`${item.item_image}`" />
                      <button
                        type="button"
                        class="close d-flex align-center justify-center"
                        data-dismiss="modal"
                        aria-label="Close"
                      >
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h5 class="modal-title" id="exampleModalLabel">{{ item.item_name }}</h5>
                      <p>
                        {{ item.item_discription }}
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

      <v-col md="3" cols="12" class="cart-item">
        <shop-cart @cart-empty-check="cartEmptyCheck" :cartEmpty="cartEmpty" />
      </v-col>

      <transition>
        <v-col md="3" cols="12" v-show="cartItem">
          <shop-cart @cart-empty-check="cartEmptyCheck" :cartEmpty="cartEmpty" />
        </v-col>
      </transition>
    </v-row>

    <!-- <div >
      <shop-cart />
    </div> -->
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data: () => ({
    shopitems: '',
    storeUser: {},
    SelectedItems: {},
    shopData: '',
    store: '',
    cartItem: false,
    cartEmpty: true,
  }),

  computed: mapGetters(['cartItems']),

 
  created() {
    this.shopDataGet();
    this.getStoreUser();
    this.cartEmptyCheck();
    this.addStoreId(this.$route.params.id);
  },

  methods: {
    shopDataGet() {
      axios
        .get('/shopDataGet/' + this.$route.params.id)
        .then(response => {
          this.shopData = response.data;
          // console.log(this.shopData);
        })
        .catch(error => console.log(error));
    },
    getStoreUser() {
      axios
        .get('/storeImage/' + this.$route.params.id)
        .then(response => {
          this.storeUser = response.data[0];
          this.storeName = response.data.name;
          // console.log(this.storeUser);
          
        })
        .catch(error => console.log(error));
    },

    storeDataGet() {
      axios
        .get('/storeGet/' + this.$route.params.id)
        .then(response => {
          // console.log(response.data);
          this.store = response.data;
        })
        .catch(error => console.log(error));
    },
    addItemCart(item) {
      this.$store.dispatch('addItemCart', item);
      this.cartEmptyCheck();
    },
    addStoreId(id) {
      this.$store.dispatch('addStoreId',id);
    },
    cartBtn() {
      this.cartItem = !this.cartItem;
    },
    cartEmptyCheck() {
      if (this.cartItems.length > 0) {
        this.cartEmpty = false;
      } else {
        this.cartEmpty = true;
      }
      // console.log('ok');
    },
  },

  // computed: mapGetters(['cartItems']),
};
</script>

<style scoped>
.modal {
  top: 20%;
}

.modal-header {
  padding: 0;
  position: relative;
}

.modal-header img {
  width: 100%;
  height: 300px;
}

.close {
  position: absolute;
  right: 20px;
  top: 20px;
  width: 50px;
  height: 50px;
  background: white;
  border-radius: 50%;
}

.close span {
  padding: 0px 0px 3px;
}

.card {
  cursor: pointer;
}

.card .item-image {
  height: 200px;
  width: 100%;
  /* background-size: cover; */
}

.card .item-image img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.shop {
  margin-top: 64px;
}

.mp-0 {
  margin: 0;
  padding: 0;
}

.shop-item {
  padding: 0;
}

.cart-item {
  padding: 0;
  border-left: solid 1px gray;
  position: relative;
}

.paid-btn {
  position: absolute;
  bottom: 20px;
}

.cart-btn {
  display: none;
}

@media (max-width: 670px) {
  .cart-item {
    display: none;
  }

  .cart-btn {
    display: block;
  }

  .v-enter-active,
  .v-leave-active {
    transition: opacity 0.5s;
  }

  .v-enter,
  .v-leave-to {
    opacity: 0;
  }
}
</style>
