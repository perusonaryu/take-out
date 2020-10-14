<template>
  <!-- Modal -->
  <div
    class="modal fade"
    id="editModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content container">
        <form>
          <h1 class="d-flex justify-center">StoreCreate</h1>
          <v-text-field v-model="storeName" label="店名,"> </v-text-field>
          <v-text-field v-model="address" label="住所"></v-text-field>
          <v-text-field v-model="introduction" label="紹介文"></v-text-field>
          <v-text-field v-model="category" label="カテゴリー"></v-text-field>

          <v-file-input
            multiple
            label="店舗画像"
            prepend-inner-icon="mdi-camera"
            prepend-icon
            show-size
            v-on:change="fileSelected"
          ></v-file-input>
          <!-- <p>
              <input type="file" v-on:change="fileSelected">
            </p> -->

          <v-btn class="mr-4" @click="update(storeUser.id)" data-dismiss="modal">保存</v-btn>
          <v-btn @click="clear" data-dismiss="modal">clear</v-btn>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import { validationMixin } from 'vuelidate'
// import { required, maxLength, email } from 'vuelidate/lib/validators'

// let storeName = this.storeToEdit.store_name;
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
    storeName: '',
    address: '',
    introduction: '',
    category: '',
    imageInfo: '',
  }),

  // computed: {
  //   storeNameErrors () {
  //     const errors = []
  //     if (!this.$v.storeName.$dirty) return errors
  //     // !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
  //     !this.$v.storeName.required && errors.push('storeName is required.')
  //     return errors
  //   },
  //   addressErrors () {
  //     const errors = []
  //     if (!this.$v.address.$dirty) return errors
  //     !this.$v.address.required && errors.push('address is required')
  //     return errors
  //   },
  //   introductionErrors () {
  //     const errors = []
  //     if (!this.$v.introduction.$dirty) return errors
  //     !this.$v.introduction.required && errors.push('introduction is required')
  //     return errors
  //   },
  //   categoryErrors () {
  //     const errors = []
  //     if (!this.$v.category.$dirty) return errors
  //     !this.$v.category.required && errors.push('category is required')
  //     return errors
  //   },

  // },

  created() {
    this.getStoreUser();
  },
  methods: {
    getStoreUser() {
      axios
        .get('/storeusers/user')
        .then(response => {
          this.storeUser = response.data;
          this.storeName = response.data.name;
          this.address = response.data.address;
          this.introduction = response.data.introduction;
          this.category = response.data.category;
          // console.log(this.storeUser);

          // this.storeId = response.data.id;
        })
        .catch(error => console.log(error));
    },

    clear() {
      // this.$v.$reset()
      this.storeName = '';
      this.address = '';
      this.introduction = '';
      this.category = '';
      // console.log(this.storeToEdit);
    },
    update(id) {
      let imageData = new FormData();
      imageData.append('store_name', this.storeName);
      imageData.append('address', this.address);
      imageData.append('introduction', this.introduction);
      imageData.append('category', this.category);
      imageData.append('file', this.imageInfo);

      axios
        .post('/storeUserUpdate/' + id, imageData, {
          headers: {
            'X-HTTP-Method-Override': 'PUT',
          },
        })
        .then(response => {
          this.$emit('update');
          console.log('update');
        })
        .catch(error => console.log(error));
    },
    fileSelected(event) {
      // console.log(event.target.files[0]);
      // this.imageInfo = event.__ob__.value[0];
      this.imageInfo = event[0];
      // this.imageInfo = event.target.files[0];
      // console.log(this.imageInfo);
    },
  },
};
</script>

<style></style>
