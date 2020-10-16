<template>
  <div class="wrapper">
    <v-row class="mp-0">
      <store-navi />
      <v-col md="9">
        <v-container>
          <h1>注文履歴</h1>
          <p>
            受け渡し完了後注文アイテムをタップし、<br />
            注文完了ボタンを押して下さい
          </p>
          <div class="item-wrapper" v-for="item in Items" :key="item.id">
            <div class="price">{{ item.item_total_price }}</div>
            <div class="time">{{ item.pickup_date_time }}</div>
            <button
              type="button"
              class="btn"
              data-dismiss="modal"
              @click="complete(item)"
              data-toggle="modal"
              data-target="#CompleteModal"
              style="background-color:#ffd700;"
            >
              詳細
            </button>
            <order-not-complete-modal
              :val="Item"
              v-if="showContent === item.id"
              @update="getBoughtItem(store.id)"
              @close="closeModal"
            ></order-not-complete-modal>
          </div>
        </v-container>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data: () => ({
    User: '',
    Items: '',
    store: '',
    //モーダル
    showContent: false,
    Item: '',
  }),
  mounted() {
    this.getThisStore();
  },
  created() {
    this.getBoughtItem();
  },

  methods: {
    getThisStore() {
      axios
        .get('/storeusers/user')
        .then(response => {
          this.store = response.data;
          // console.log(this.store.id);
          this.getBoughtItem(this.store.id);
        })
        .catch(error => console.log(error));
    },
    getBoughtItem(id) {
      axios
        .get('/storebuy/' + id)
        .then(response => {
          this.Items = response.data;
          // console.log(this.Items);
          // this.getUser(this.Items.user_id);
        })
        .catch(error => console.log(error));
    },

    complete(item) {
      this.showContent = item.id;
      this.Item = item;
      // }
    },
    closeModal() {
      this.showContent = false;
      this.showContent = '';
    },
  },
};
</script>

<style>
.item-wrapper {
  display: flex;
  justify-content: space-around;
  align-items: center;
  border: solid 3px #ffd700;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.2);
  height: 50px;
  width: 500px;
  border-radius: 20px;
  margin: 50px 0px;
}
/* .navi{
    border-right: solid 5px #ffd700;
} */
</style>
