<template>
  <div
    class="modal"
    id="itemaddmodal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form>
          <h1 class="d-flex justify-center">商品追加</h1>
          <label
            >商品画像
            <input type="file" @change="itemImageSelect" v-if="view" id="img" />
          </label>
          <p v-if="selectedImage" style="width:100px;height:200px;">
            <img class="img" :src="selectedImage" style="width:100%;" />
          </p>
          <v-text-field v-model="StoreItemName" label="商品名" required> </v-text-field>
          <v-text-field v-model="Price" label="値段" required></v-text-field>
          <v-textarea auto-grow v-model="Discription" label="商品説明" required></v-textarea>
          <v-select
            v-model="ItemStatus"
            label="商品状況"
            :items="StatusItems"
            name="StatusItems"
            required
          ></v-select>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            <button type="button" class="btn btn-primary" @click="addStoreItem">商品追加</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
//vuelidate
import { validationMixin } from 'vuelidate';
import { required } from 'vuelidate/lib/validators';

export default {
  name: 'Modal',
  props: ['val'],

  // mixins: [validationMixin],

  // validations: {
  //   StoreItemName: { required },
  // //   file: { required },
  //   Price:{required},
  //   Discription:{required},
  //   ItemStatus: {required},

  // },
  data: () => ({
    StoreItemName: '',
    file: '',
    Price: '',
    Discription: '',
    ItemStatus: '',
    view: true,
    selectedImage: '',
    // storeId:"",
    StatusItems: ['売り切れ', '販売中'],
  }),
  mounted() {
    const vm = this;
    Vue.nextTick(function() {
      console.log(vm.val);
    });
  },

  // computed: {
  //   itemNameErrors () {
  //     const errors = []
  //     if (!this.$v.StoreItemName.$dirty) return errors
  //     !this.$v.StoreItemName.required && errors.push('商品名を入力して下さい')
  //     return errors
  //   },

  // },

  methods: {
    addStoreItem() {
      //Laravel側のapiへPOSTするデータとしてFormData オブジェクトを利用
      let data = new FormData();
      data.append('item_name', this.StoreItemName);
      data.append('file', this.file);
      data.append('price', this.Price);
      data.append('item_status', this.ItemStatus);
      data.append('item_discription', this.Discription);
      data.append('store_id', this.val);
      const config = {
        headers: {
          'content-type': 'multipart/form-data',
        },
      };
      axios
        .post('/api/StoreItems', data)
        .then(response => {
          // this.getStoreItem();
          this.$emit('add');
          this.StoreItemName = '';
          this.file = '';
          this.Price = '';
          this.ItemStatus = '';
          this.Discription = '';
          this.selectedImage = '';

          // ファイルを選択のクリア
          var img = document.getElementById('img');
          img.value = '';
          //確認ログを出す+このバリデーションを消す

          // this.view = false;
          // this.$nextTick(function() {
          //     this.view = true;
          // });
        })
        .catch(err => {
          this.message = err;
        });
    },

    itemImageSelect(e) {
      this.message = '';
      this.file = e.target.files[0];
      if (!this.file.type.match('image.*')) {
        this.message = '画像ファイルを選択して下さい';
        this.selectedImage = '';
        return;
      }
      this.createItemImage(this.file);
    },

    createItemImage(file) {
      //FileReaderのインスタンスを作成しfileを読み込む
      let reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = e => {
        this.selectedImage = e.target.result;
      };
    },
  },
};
</script>
<style scoped>
.v-input {
  color: black !important;
}
</style>
