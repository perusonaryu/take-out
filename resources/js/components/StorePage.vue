<template>
  <div>
    <store-image v-bind:storeName = "storeUser.name" />
    <v-btn text color="primary" data-toggle="modal" data-target="#editModal" >
      編集
    </v-btn>
    <v-btn text color="primary" @click.prevent="logout">
      ログアウト
    </v-btn>
    <!-- Modal -->
    <v-container>
      <store-edit  @update = "getStoreUser"/>
      <v-row>
        <div class="store-item-list" v-for="storeitem in storeitems" :key="storeitem.id" style="width:100px; height:330px">
                <div class="img-wrapper">
                    <img :src="`${storeitem.item_image}`" alt="商品の画像です" style="width:100%; height:150px">
                </div>
                <div class="item-detail-section" style="width:100%; height:150px text-align:center;">

                    <div class="item-name" style="width:100px; height:50px">
                        {{ storeitem.item_name }}
                    </div>

                    <div class="item-price" style="width:100px; height:50px">
                        {{ storeitem.price}}
                    </div>

                    <div class="item-status" style="width:100px; height:50px">
                        {{ storeitem.item_status}}
                    </div>
                </div>

  
                <div class="button-section">
                  <!-- :disabled="isPush" storeitem.item_name, storeitem.price,storeitem.item_status, storeitem.item_image一旦おいとく -->
                    <button 
                        @click="displayUpdate(storeitem)"
                        
                    >
                        編集
                    </button>

                    <!-- <button :disabled="isPush" @click="deleteStoreItem(storeitem.id)">
                        削除
                    </button> -->
                </div>
                <!-- 編集モーダル -->
                <store-item-edit :val="storeItem" v-if="storeitem.id === showContent" @close="closeStoreEditModal"></store-item-edit>
          </div>

          <div class="add-modal-window">
            <p>追加ボタンを押すと商品追加モーダルが表示されます</p>
            <button @click="openModal">商品追加</button>
            
            <!-- 商品追加モーダル storeItemAddコンポーネント -->
            <store-item-add @close="closeStoreAddModal" v-if="modal"></store-item-add>
          </div>

      </v-row>
    </v-container>
    <!-- デバック -->
    <p v-if="message">{{ message }}</p>
  </div>
  
  

</template>

<script>
// import { validationMixin } from 'vuelidate'
// import { required, maxLength, email } from 'vuelidate/lib/validators'

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
      confirmedImage: "",
      item_name: "",
      item_status: "",
      price: "",
      message: "",
      file: "",
      modal: false,
      //商品編集モーダル
      showContent: false,
      storeItem: "",
    
    
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
    
        
    created(){
      this.getStoreUser();
      //商品
      this.getStoreItem();
    },
    methods:{
      getStoreUser(){
        axios.get('/storeusers/user')
        .then(response=>{
          this.storeUser = response.data;
          this.storeName = response.data.name;
          // this.address = response.data.address;
          // this.introduction   = response.data.introduction;
          // this.category   = response.data.category;
          // this.storeId = response.data.id;

        })
        .catch(error => console.log(error));
      },

      Delete(id){
          console.log(id);
          axios.delete('/storeDelete/' + id)
            .then(response => this.stores = response.data )
            .catch(error => console.log(error));
      },


      clear () {
        // this.$v.$reset()
        this.nastoreName = ''
        this.address = ''
        this.introduction = ''
        this.category = ''
        // console.log(this.storeToEdit);
      },

      

      logout(){
        axios.post('/storeusers/logout').then(()=>{
            this.$router.push({ name: "storeLogin"})
        })
      },

//商品リストの読み込み
      getStoreItem() {
            axios
                .get("/api/StoreItems/")
                .then(response => {
                    this.storeitems = response.data;
                    console.log(response.data);
                })
                .catch(err => {
                    this.message = err;
                });
        },
        //商品編集モーダル
        displayUpdate(storeitem){
          this.showContent = storeitem.id
          this.storeItem = storeitem
        },
        closeStoreEditModal(){
          this.showContent = false
        },

//商品追加モーダルの開閉
        openModal() {
          this.modal = true
        },
        closeStoreAddModal() {
          this.modal = false
        },
    

    }
  }

</script>

<style scoped>
a{
  text-decoration: none;
  
}

input{
  color:black!important;
}
</style>