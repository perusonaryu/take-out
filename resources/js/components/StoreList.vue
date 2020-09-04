<template>
  <div>
    <v-card
      class="mx-auto"
      max-width="300"
    >
      <v-list 

      >
        <v-subheader>StoreList</v-subheader>
          <router-link to='/storeadd'>
            <v-btn depressed text large >Create</v-btn>
          </router-link>
        
        <v-list-item-group >
          <v-list-item
            v-for="(store) in stores"
            :key="store.id"
          >
            <v-list-item-content>
              <v-list-item-title v-text="store.store_name"></v-list-item-title>


              <!-- delete button -->
              <div class="d-flex">
                <v-btn text color="error" data-toggle="modal" data-target="#deleteModal" @click="Delete(store.id)">削除</v-btn>

                <!-- <router-link to='/storeedit'>
                  <v-btn text color="primary" @click="storeEdit(store.id)">編集</v-btn>
                </router-link> -->
                <v-btn text color="primary" data-toggle="modal" data-target="#editModal" @click="storeEdit(store.id)">
                  編集
                </v-btn>
                <!-- Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content container">
                        <form>
                            <h1 class="d-flex justify-center">StoreCreate</h1>
                            <v-text-field
                            v-model="storeName"
                            :error-messages="storeNameErrors"
                            label="storeName"
                            required
                            @input="$v.storeName.$touch()"
                            @blur="$v.storeName.$touch()"
                            >  </v-text-field>
                            <v-text-field
                            v-model="address"
                            :error-messages="addressErrors"
                            label="address"
                            required
                            @input="$v.address.$touch()"
                            @blur="$v.address.$touch()"
                            ></v-text-field>
                            <v-text-field
                            v-model="introduction"
                            :error-messages="introductionErrors"
                            label="introduction"
                            required
                            @input="$v.introduction.$touch()"
                            @blur="$v.introduction.$touch()"
                            ></v-text-field>
                            <v-text-field
                            v-model="category"
                            :error-messages="categoryErrors"
                            label="category"
                            required
                            @input="$v.category.$touch()"
                            @blur="$v.category.$touch()"
                            ></v-text-field>
                            
                            <v-btn class="mr-4" @click="update" data-dismiss="modal">create</v-btn>
                            <v-btn @click="clear" data-dismiss="modal">clear</v-btn>
                        </form>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                  </div>
                </div>

              </div>
              <!-- Button trigger modal -->

              <!-- Modal -->
              <!-- <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog " role="document">
                  <div class="modal-content ">
                    <div class="modal-header d-flex justify-center">
                      <h5 class="modal-title" id="exampleModalLabel">本当に削除しますか？</h5>
                    </div>
                    <div class="modal-body d-flex justify-space-around">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal" @click="Delete(store.id)">はい</button>
                      <button type="button" class="btn btn-primary" data-dismiss="modal">いいえ</button>
                    </div>
                  </div>
                </div>
              </div> -->
            </v-list-item-content>
            <div>
              
            </div>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-card>
    </div>

</template>

<script>
import { validationMixin } from 'vuelidate'
  import { required, maxLength, email } from 'vuelidate/lib/validators'

  export default {
    mixins: [validationMixin],

    validations: {
      storeName: { required },
      address: { required },
      introduction:{required},
      category: {required},

    },

    data: () => ({
      stores: {},
      storeToEdit:'',
      storeName: '',
      address: '',
      introduction: '',
      category: '',
    }),

    computed: {
      storeNameErrors () {
        const errors = []
        if (!this.$v.storeName.$dirty) return errors
        // !this.$v.name.maxLength && errors.push('Name must be at most 10 characters long')
        !this.$v.storeName.required && errors.push('storeName is required.')
        return errors
      },
      addressErrors () {
        const errors = []
        if (!this.$v.address.$dirty) return errors
        !this.$v.address.required && errors.push('address is required')
        return errors
      },
      introductionErrors () {
        const errors = []
        if (!this.$v.introduction.$dirty) return errors
        !this.$v.introduction.required && errors.push('introduction is required')
        return errors
      },
      categoryErrors () {
        const errors = []
        if (!this.$v.category.$dirty) return errors
        !this.$v.category.required && errors.push('category is required')
        return errors
      },
      
    },
    
    created(){
      axios.get('http://127.0.0.1:8000/storeList')
        .then(response => this.stores = response.data)
        .catch(error => console.log(error));
    },
    methods:{
      Delete(id){
          console.log(id);
          axios.delete('/storeDelete/' + id)
            .then(response => this.stores = response.data )
            .catch(error => console.log(error));
      },
      // storeEdit(id){
      //   axios.get('/storeEdit/' + id)
      //     .then(response => this.storeToEdit = response.data)
      //     .catch(error => console.log(error));
      //   this.storeToEdit = id;
      //   console.log(id);
      //   this.$refs.edit[i].editget(this.storeToEdit);
      //   this.$refs.edit[i].editget();
      //   console.log(this.$refs.edit[i].editget());
      //   console.log(this.$refs.edit[i]._data.address);
      //   console.log(id);
      // },

      clear () {
        this.$v.$reset()
        this.nastoreName = ''
        this.address = ''
        this.introduction = ''
        this.category = ''
        // console.log(this.storeToEdit);
      },

      storeEdit(id){
          axios.get('/storeEdit/' + id)
          .then(response => {
              (this.storeName = response.data.store_name);
              (this.address = response.data.address);
              (this.introduction   = response.data.introduction);
              (this.category   = response.data.category);
            //   (console.log(response.data));
          })
          .catch(error => console.log(error));
        // console.log(this.storeName);
        this.storeToEdit = id;
      },
      update(){
        axios.patch('/storeEdit/' + this.storeToEdit,{
          store_name:this.storeName,
          address:this.address,
          introduction:this.introduction,
          category:this.category
        })
        .then(response => this.stores = response.data)
        .catch(error => console.log(error));
      }

    }
  }

</script>

<style scoped>
a{
  text-decoration: none;
}
</style>