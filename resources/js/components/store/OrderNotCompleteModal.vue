<template>
  <div
    class="modal"
    id="CompleteModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="text-align: center">
        <h1 class="d-flex justify-center">商品一覧</h1>
        <div>{{ val.item_info }}</div>
        <div>{{ UserName}}</div>
        <div>{{ val.item_total_price }}</div>
        <div>{{ val.pickup_date_time }}</div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
          <button
            type="button"
            class="btn btn-primary"
            data-dismiss="modal"
            @click="completeDelivery"
          >
            受け渡し完了
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Modal',
  props: ['val'],
   data: () => ({
    User: '',
    UserName: '',
  }),
  mounted() {
    console.log(this.val);
    this.getUser(this.val.user_id);
  },
  methods: {
    completeDelivery() {
      let data = new FormData();
      data.append('id', this.val.id);
      data.append('pickup_status', 1);
      axios
        .post('/storebuy/' + this.val.id, data)
        .then((res) => {
          console.log(response.data);
          this.$emit('update');
        })
        .catch((err) => {
          console.log(err);
        });
    },
     getUser(id) {
      const userId = id;
      axios
        .get('/userinfo/' + userId)
        .then((response) => {
          this.User = response.data;
          console.log(response.data);
          this.UserName = this.User.name;
        })
        .catch((error) => console.log(error));
    },
  },
};
</script>

<style>
</style>