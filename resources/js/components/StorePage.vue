<template>
  <div>
    <store-image v-bind:store = "storeUser" />
    <v-btn text color="primary" data-toggle="modal" data-target="#editModal" >
      編集
    </v-btn>
    <v-btn text color="primary" @click.prevent="logout">
      ログアウト
    </v-btn>
    <!-- Modal -->
    <v-container>
      <!-- 店編集モーダル -->
      <store-edit  @update = "getStoreUser" />
      <!-- 商品追加モーダル -->
      <store-item-add @add = "getStoreItem" :val="addItem"></store-item-add>
      
      <!-- <store-item-add @add = "getStoreItem" :id="storeUser.id" />
      <store-item-edit :val="storeItem" v-if="showContent" @close="closeStoreEditModal" @itemUpdate = "getStoreItem"></store-item-edit> -->
      <v-row>
        <v-col lg="3" md="4" cols="12" class="store-item-list" v-for="storeitem in storeitems" :key="storeitem.id">
          <v-img 
            height="100%"
            width="100%"
            :src="storeitem.item_image">
          </v-img>
           <div class="item-detail-section" style="text-align:center;">

                    <div class="item-name" >
                        {{ storeitem.item_name }}
                    </div>

                    <div class="item-price" >
                        {{ storeitem.price}}
                    </div>

                    <div class="item-status" >
                        {{ storeitem.item_discription}}
                    </div>

                    <div class="item-status" >
                        {{ storeitem.item_status}}
                    </div>
                </div>
                <div class="button-section" style="display:flex; justify-content:space-around;">
                   <v-btn text color="primary" data-toggle="modal" data-target="#itemeditmodal" @click="displayUpdate(storeitem)">
                    編集
                  </v-btn>
                  <v-btn  @click="deleteStoreItem(storeitem.id)" type="button">
                    削除
                  </v-btn>
                </div>
          <!-- <div class="item-detail-section" style="text-align:center;">

              <div class="item-name" >
                  {{ storeitem.item_name }}
              </div>

              <div class="item-price" >
                  {{ storeitem.price}}
              </div>

              <div class="item-status" >
                  {{ storeitem.item_status}}
              </div> -->
            <!-- <div class="button-section" style="display:flex; justify-content:space-around;">
              <v-btn text color="primary" data-toggle="modal" data-target="#itemeditmodal" @click="displayUpdate(storeitem)">
                編集
              </v-btn>
              <v-btn  @click="deleteStoreItem(storeitem.id)" type="button">
                削除
              </v-btn>
            </div> -->
          <!-- </div> -->
           <store-item-edit :val="editItem" v-if="showContent===storeitem.id" @close="closeStoreEditModal" @itemUpdate = "getStoreItem"></store-item-edit>    
        </v-col>
        <!-- <div class="store-item-list" v-for="storeitem in storeitems" :key="storeitem.id" style="width:100px; height:330px">
          
                <div class="img-wrapper">
                    <img :src="`${storeitem.item_image}`" alt="商品の画像です" style="width:100%; height:150px">
                </div>
                -->
  
  
      <!-- <v-col lg="3" md="4" cols="12"> -->
        <v-btn text color="primary" data-toggle="modal" data-target="#itemaddmodal" @click="displayAdd(storeUser.id)">
          商品追加
        </v-btn>
      <!-- </v-col>  -->
      </v-row>
      
    </v-container>
    <!-- デバック -->
    <!-- <p v-if="message">{{ message }}</p> -->
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
      addmodal: false,
      addItem:"",
      //商品編集モーダル
      showContent: false,
      editItem: "",
    }),
    mounted(){
      this.getStoreUser();
      // this.getStoreItem();
    },
    created(){
      //商品
      if(this.storeUser.length > 0){
        this.getStoreItem();
      }

    },
    methods:{
      getStoreUser(){
        axios.get('/storeusers/user')
        .then(response=>{
          this.storeUser = response.data;
          this.storeName = response.data.name;
          this.getStoreItem();
        })
        .catch(error => console.log(error));
      },

      Delete(id){
          console.log(id);
          axios.delete('/storeDelete/' + id)
            .then(response => this.stores = response.data )
            .catch(error => console.log(error));
      },



      

    logout(){
      axios.post('/storeusers/logout').then(()=>{
          this.$router.push({ name: "storeLogin"})
      })
    },

    //商品リストの読み込み
    // getStoreItem() {
    //   axios.get("/shopDataGet/" + this.storeUser.id)
    //   .then(response => {
    //       this.storeitems = response.data;
    //       console.log(response.data);
    //   })
    //   .catch(eroor => console.log(error));
    // },
    getStoreItem(){
      const storeId = this.storeUser.id;
      axios.get('/shopDataGet/'+ storeId)
      .then(response => {
        this.storeitems = response.data;
        console.log(response.data);
      })
      .catch( error => console.log(error));
    },

//商品リストの読み込み
      
        //商品編集モーダル
        displayUpdate(storeitem){
          // this.showContent = storeitem.id;
          // if(this.showContent===storeitem.id){
            this.showContent = storeitem.id;
            this.editItem = storeitem
          // }
          
        },
        closeStoreEditModal(){
          this.showContent = false
          this.showContent='';
        },

//商品追加モーダルの開閉
        openModal() {
          this.addmodal = true
        },
        closeStoreAddModal() {
          this.addmodal = false
        },

        displayAdd(id){
          this.addItem=id;
          console.log(this.addItem);
        },
    
 deleteStoreItem(id) {
            axios
                .delete("/api/StoreItems/" + id)
                .then(response => {
                    this.getStoreItem();
                })
                .catch(err => {
                    console.log(err);
                });
        }
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