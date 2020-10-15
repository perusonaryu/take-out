<template>
  <div class="user-order-wrapper">
    <Header/>
    <h1 style="text-align:center;margin-top:50px;">注文履歴</h1>
    <p style="text-align:center">
      アイテムをクリックすると、詳細が見れます<br />
      受け取りの際にご確認下さい
    </p>
    <div
      class="item-box"
      v-for="item in Items"
      :key="item.id"
      data-toggle="modal"
      :data-target="`#itemModal${item.id}`"
    >
      <div class="price">{{ item.item_total_price }}</div>
      <div class="time">{{ item.pickup_date_time }}</div>
      <div class="time">{{ item.pickup_date_time }}</div>

      <div
        class="modal fade"
        :id="`itemModal${item.id}`"
        tabindex="-1"
        role="dialog"
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog" role="document">
          <div class="modal-content" style="text-align: center">
            <h1 class="d-flex justify-center">注文情報</h1>
            <div>{{ item.item_info }}</div>
            <div>{{ item.item_total_price }}</div>
            <div>{{ item.pickup_date_time }}</div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data: () => ({
    User: '',
    Items: '',
  }),

  mounted: function() {
    this.getThisUser();
  },
  methods: {
    getThisUser() {
      axios
        .get('/user')
        .then(response => {
          this.User = response.data;
          this.getBoughtItem(this.User.id);
        })
        .catch(err => {
          // this.message = err;
          console.log(err);
        });
    },
    getBoughtItem(id) {
      axios
        .get('/userboughtitem/' + id)
        .then(response => {
          this.Items = response.data;
          console.log(this.Items);
          //   this.getUser(this.Items.user_id);
        })
        .catch(error => console.log(error));
    },
  },
};
</script>
<style>
.item-box {
  display: flex;
  justify-content: space-around;
  align-items: center;
  border: solid 5px #ffd700;
  height: 50px;
  width: 500px;
  border-radius: 20px;
  margin: 50px auto;
}
.user-order-wrapper{
  margin-top: 64px;
}
</style>
