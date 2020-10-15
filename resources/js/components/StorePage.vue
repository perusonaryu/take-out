<template>
  <div class="store">
    <v-row class="mp-0">
      <store-navi/>
      
      <v-col md="9" class="shop-item">
        <store-image v-bind:store="storeUser" />
        <v-btn text color="primary" data-toggle="modal" data-target="#editModal"> 編集 </v-btn>
        <v-btn text color="primary" @click.prevent="logout"> ログアウト </v-btn>
        <!-- Modal -->
        <v-container>
          <!-- 店編集モーダル -->
          <store-edit @update="getStoreUser" />
          <!-- 商品追加モーダル -->
          <store-item-add @add="getStoreItem" :val="addItem"></store-item-add>

          <v-row justify="space-between" align="center" class="mp-0">
            <v-col
              lg="3"
              md="4"
              cols="12"
              class="store-item-list d-flex justify-center"
              v-for="storeitem in storeitems"
              :key="storeitem.id"
            >
              <div class="card" style="width: 300px">
                <div class="card-img">
                  <img width="100%" :src="storeitem.item_image"  />
                </div>
                <div class="item-detail-section" style="text-align: center">
                  <div class="item-name">
                    {{ storeitem.item_name }}
                  </div>

                  <div class="item-price">
                    {{ storeitem.price }}
                  </div>
                </div>
                <div class="button-section" style="display: flex; justify-content: space-around">
                  <v-btn
                    text
                    color="primary"
                    data-toggle="modal"
                    data-target="#itemeditmodal"
                    @click="displayUpdate(storeitem)"
                  >
                    編集
                  </v-btn>
                  <v-btn @click="deleteStoreItem(storeitem.id)" type="button"> 削除 </v-btn>
                </div>
              </div>
              <!-- 商品編集モーダル -->
              <store-item-edit
                :val="editItem"
                v-if="showContent === storeitem.id"
                @close="closeStoreEditModal"
                @itemUpdate="getStoreItem"
              ></store-item-edit>
            </v-col>
            <!-- 商品追加ボタン -->
            <v-col lg="3" md="4" cols="12" class="d-flex justify-center">
              <v-btn
                text
                color="primary"
                data-toggle="modal"
                data-target="#itemaddmodal"
                @click="displayAdd(storeUser.id)"
              >
                商品追加
              </v-btn>
            </v-col>
          </v-row>
        </v-container>
      </v-col>
    </v-row>
  </div>
</template>

<script>
// import { validationMixin } from 'vuelidate'
// import { required, maxLength, email } from 'vuelidate/lib/validators'
// Pusher.logToConsole = true;
// import Echo from 'laravel-echo';

export default {
  // mixins: [validationMixin],

  // validations: {
  //   storeName: { required },
  //   address: { required },
  //   introduction:{required},
  //   category: {required},
  // },

  data: () => ({
    storeUser: {},
    // storeId:'',
    storeName: '',
    address: '',
    introduction: '',
    category: '',
    // 商品追加 storeitem
    storeitems: {},
    addmodal: false,
    addItem: '',
    //商品編集モーダル
    showContent: false,
    editItem: '',
  }),
  mounted() {
    this.getStoreUser();
    // this.getStoreItem();
  },
  created() {
    //商品
    if (this.storeUser.length > 0) {
      this.getStoreItem();
      this.orderNotification();
    }
  },

  methods: {
    getStoreUser() {
      axios
        .get('/storeusers/user')
        .then((response) => {
          this.storeUser = response.data;
          this.storeName = response.data.name;
          this.getStoreItem();
          this.orderNotification();
        })
        .catch((error) => console.log(error));
    },

    Delete(id) {
      console.log(id);
      axios
        .delete('/storeDelete/' + id)
        .then((response) => (this.stores = response.data))
        .catch((error) => console.log(error));
    },

    logout() {
      axios.post('/storeusers/logout').then(() => {
        this.$router.push({ name: 'storeLogin' });
      });
    },

    getStoreItem() {
      const storeId = this.storeUser.id;
      axios
        .get('/shopDataGet/' + storeId)
        .then((response) => {
          this.storeitems = response.data;
          // console.log(response.data);
        })
        .catch((error) => console.log(error));
    },

    //商品リストの読み込み

    //商品編集モーダル
    displayUpdate(storeitem) {
      // this.showContent = storeitem.id;
      // if(this.showContent===storeitem.id){
      this.showContent = storeitem.id;
      this.editItem = storeitem;
      // }
    },
    closeStoreEditModal() {
      this.showContent = false;
      this.showContent = '';
    },

    //商品追加モーダルの開閉
    openModal() {
      this.addmodal = true;
    },
    closeStoreAddModal() {
      this.addmodal = false;
    },

    displayAdd(id) {
      this.addItem = id;
      console.log(this.addItem);
    },

    deleteStoreItem(id) {
      axios
        .delete('/api/StoreItems/' + id)
        .then((response) => {
          this.getStoreItem();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    orderNotification() {
      const id = this.storeUser.id;
      // console.log(id);
      Echo.private('my-channel.' + id)
        // Echo.channel('my-channel')
        .listen('.my-event', function (data) {
          // console.log(data);
          $.notify(data.order.message, 'info');
        });
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}

input {
  color: black !important;
}

.card .card-img {
  height: 200px;
  width: 100%;
}

.card .card-img img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
