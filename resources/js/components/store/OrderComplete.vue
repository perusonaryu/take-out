<template>
    <div class="wrapper">
    <v-row class="mp-0">
      <store-navi/>
      <v-col md="9">
        <v-container>
          <h1>注文完了履歴</h1>
          <p>
            受け渡し済みの商品です
          </p>
          <div class="item-wrapper" v-for="item in Items" :key="item.id">
            <div class="price">{{ item.item_total_price }}</div>
            <div class="time">{{ item.pickup_date_time }}</div>
            <button
              type="button"
              class="btn"
           
            >
               <!-- data-dismiss="modal"
              @click="complete(item)"
              data-toggle="modal"
              data-target="#CompleteModal"
              style="background-color:#ffd700;" -->
              詳細
            </button>
            
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
  
  }),
  mounted() {
    this.getThisStore();
  },
  methods: {
    getThisStore() {
      axios
        .get('/storeusers/user')
        .then((response) => {
          this.store = response.data;
          console.log(this.store.id);
          this.getDeliveriedItem(this.store.id);
        })
        .catch((error) => console.log(error));
    },
     getDeliveriedItem(id) {
      axios
        .get('/deleveried/' + id)
        .then((response) => {
          this.Items = response.data;
          console.log(this.Items);
          //   this.getUser(this.Items.user_id);
        })
        .catch((error) => console.log(error));
    },
  }
}
</script>

<style>

</style>