<template>
  <v-container>
    <div class="cart">
      <h1>注文詳細</h1>
      <ul v-for="item in cartItems" :key="item.id">
        <span>
          <input type="text" />
          {{ item.itemName }}
        </span>
        <span>
          <input type="text" />
          {{ item.price }}円
        </span>
        <span>
          <input type="text" />
          {{ item.quantity }}個
        </span>
      </ul>
      <p>合計金額： {{ cartTotalPrice }}(税込み)</p>
    </div>

    <div class="card">
      <ul class="list-group">
        <li class="list-group-item">
          <span>カード番号： </span>
          {{ cardData.number }}
        </li>
        <li class="list-group-item">
          <span>カード有効期限(月/年)：</span>
          {{ cardData.exp_month }}/{{ cardData.exp_year }}
        </li>
        <li class="list-group-item">
          <span>カード名義：</span>
          {{ cardData.name }}
        </li>
        <li class="list-group-item">
          <span>カードブランド：</span>
          {{ cardData.brand }}
        </li>
      </ul>
    </div>

    <label>受け取り時間 </label>

    <div>
      <button type="button" @click="shopSettle">決済</button>
    </div>
  </v-container>
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
    ...mapGetters(['cartItems', 'cartTotalPrice']),
  },
  mounted() {
    this.getCardData();
  },
  methods: {
    getCardData() {
      axios
        .get('/user/payment')
        .then((response) => {
          console.log(response.data);
          // this.userData = response.data.user;
          this.cardData = response.data.defaultCard;
        })
        .catch((error) => {
          this.$router.push({ name: 'userpaymentform' });
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

    emptyItemCart() {
      this.$store.commit('emptyItemCart');
    },
  },
};
</script>

<style>
</style>