<template>
  <div>
    <v-img :src="`${selectedStore.storeImage}`" height="300">
      <div class="d-flex align-center h-100">
        <div class="store-text">
          <h3>{{ selectedStore.storeName }}</h3>
        </div>
      </div>
    </v-img>
    <!-- <img :src="`${selectedStore.storeImage}`" alt="" /> -->
    <v-row justify="center">
      <v-col md="8">
        <div class="d-flex justify-space-between">
          <h3>注文内容</h3>
          <router-link
            :to="{
              name: 'shop',
              params: { id: $store.state.storeId },
            }"
          >
            <v-btn color="#ffd700">商品を追加する</v-btn>
          </router-link>
        </div>

        <table class="table">
          <tbody>
            <tr v-for="item in cartItems" :key="item.id">
              <th>{{ item.itemName }}</th>
              <td>x{{ item.quantity }}</td>
              <td>{{ item.price }}円</td>
              <!-- <td>合計金額： {{ cartTotalPrice }}(税込み)</td> -->
            </tr>
          </tbody>
        </table>
        <div class="d-flex justify-end">
          <h5 class="mr-4">お支払い金額</h5>
          <p>{{ cartTotalPrice }}(税込み)</p>
        </div>

        <ul>
          <div class="list-group">
            <p class="list-group-item">
              <span>お支払いに使うカード： </span>
              {{ cardData.number }}
            </p>
          </div>
        </ul>

        <div class="d-flex">
          <h5>受け取り時間</h5>
          <input type="text" v-model="PickUpTime" />
        </div>

        <div class="d-flex justify-end">
          <v-btn color="#ffd700" @click="postConfirmData">注文</v-btn>
        </div>
      </v-col>
    </v-row>

    <button @click="logout">logout</button>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {
  data() {
    return {
      cardData: '',
      PickUpTime: '',
    };
  },
  computed: {
    ...mapGetters(['cartItems', 'cartTotalPrice', 'selectedStore']),
  },
  mounted() {
    this.getCardData();
    this.getStore(this.$store.state.storeId);
  },
  methods: {
    getCardData() {
      axios
        .get('/user/payment')
        .then((response) => {
          // console.log(response.data);
          // this.userData = response.data.user;
          this.cardData = response.data.defaultCard;
        })
        .catch((error) => {
          this.$router.push({ name: 'userpaymentform' });
        });
    },

    getStore(storeId) {
      this.$store.dispatch('addSelectedStore', storeId);
    },

    postConfirmData() {
      // console.log(this.cartItems[0].itemName);
      // console.log(this.cartTotalPrice);
      // console.log(this.PickUpTime);
      let ItemInfo = [
        this.cartItems[0].itemName,
        this.cartItems[0].price,
        this.cartItems[0].quantity,
      ];
      let data = new FormData();
      data.append('item_info', ItemInfo);
      data.append('item_total_price', this.cartTotalPrice);
      data.append('pickup_date_time', this.PickUpTime);
      data.append('store_id', this.$store.state.storeId);
      axios
        .post('/storebuy', data)
        .then((response) => {
          this.notification(this.$store.state.storeId);
          this.shopSettle();
        })
        .catch((err) => {
          this.message = err;
        });
    },

    shopSettle() {
      let data = new FormData();
      data.append('price', this.cartTotalPrice);

      axios
        .post('/user/paid', data)
        .then((response) => {
          this.emptyItemCart();
          this.$router.push({ name: 'SettleComplete' });
        })
        .catch((error) => console.log(error));
    },

    notification(id) {
      axios
        .get('/sent/' + id)
        .then((response) => {
          console.log('サクセス');
        //   this.$router.push({ name: 'Settle' });
        })
        .catch((error) => console.log(error));
    },
    emptyItemCart() {
      this.$store.commit('emptyItemCart');
    },
    logout() {
      axios.post('/logout').then(() => {
        this.$router.push({ name: 'login' });
      });
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}

ul {
  padding: 0;
}

.store-text {
  margin-left: 40px;
  background-color: white;
  border-radius: 10px;
}

.store-text h3 {
  margin: 5px 10px;
}

.table th,
.table td {
  border-bottom: 1px solid #dee2e6;
  border-top: 0;
}
</style>