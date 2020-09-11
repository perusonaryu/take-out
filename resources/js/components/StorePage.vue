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
      <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content container">
              <form>
                  <h1 class="d-flex justify-center">StoreCreate</h1>
                  <v-text-field
                  v-model="storeName"
                  label="storeName"
                  
                  >  </v-text-field>
                  <v-text-field
                  v-model="address"
                  label="address"
                  ></v-text-field>
                  <v-text-field
                  v-model="introduction"
                  label="introduction"
                  ></v-text-field>
                  <v-text-field
                  v-model="category"
                  label="category"
                  ></v-text-field>
                  
                  <v-btn class="mr-4" @click="update(storeUser.id)" data-dismiss="modal">保存</v-btn>
                  <v-btn @click="clear" data-dismiss="modal">clear</v-btn>
              </form>
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
              </div>
          </div>
        </div>
      </div>
      <v-row>
      <store-item />

      </v-row>
    </v-container>
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
      storeToEdit:'',
      storeName: '',
      address: '',
      introduction: '',
      category: '',
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
      this.getStoreUser()
    },
    methods:{
      getStoreUser(){
        axios.get('/api/storeusers/user')
        .then(response=>{
          this.storeUser = response.data;
          (this.storeName = response.data.name);
          (this.address = response.data.address);
          (this.introduction   = response.data.introduction);
          (this.category   = response.data.category);

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

      update(id){
        axios.patch('/api/userUpdate/' + id,{
          store_name:this.storeName,
          address:this.address,
          introduction:this.introduction,
          category:this.category
        })
        .then(response => {
          this.getStoreUser()
        })
        .catch(error => console.log(error));
      },

      logout(){
        axios.post('/api/storeusers/logout').then(()=>{
            this.$router.push({ name: "storeLogin"})
        })
      }

    }
  }

</script>

<style scoped>
a{
  text-decoration: none;
}
</style>