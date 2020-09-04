<template>
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
            
            <v-btn class="mr-4" @click="editget">create</v-btn>
            <v-btn @click="clear">clear</v-btn>
        </form>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        </div>
    </div>
  </div>
</div>
</template>

<script>
  import { validationMixin } from 'vuelidate'
  import { required, maxLength, email } from 'vuelidate/lib/validators'

// let storeName = this.storeToEdit.store_name;
  export default {

    mixins: [validationMixin],

    validations: {
      storeName: { required },
      address: { required },
      introduction:{required},
      category: {required},

    },
    props:['storeToEdit'],
    data: () => ({
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
    
    // updated(){
        
    //     axios.get('/storeEdit/' + this.storeToEdit)
    //       .then(response => {
    //           (this.storeName = response.data.store_name);
    //           (this.address = response.data.address);
    //           (this.introduction   = response.data.introduction);
    //           (this.category   = response.data.category);
    //         //   (console.log(response.data));
    //       })
    //       .catch(error => console.log(error));
    //     console.log('おめでとう!');
    //       console.log(this.address);
    //       console.log(this.introduction);
    // },
    methods: {
      clear () {
        this.$v.$reset()
        this.nastoreName = ''
        this.address = ''
        this.introduction = ''
        this.category = ''
        // console.log(this.storeToEdit);
      },
      editget(){
          axios.get('/storeEdit/' + this.storeToEdit)
          .then(response => {
              (this.storeName = response.data.store_name);
              (this.address = response.data.address);
              (this.introduction   = response.data.introduction);
              (this.category   = response.data.category);
            //   (console.log(response.data));
          })
          .catch(error => console.log(error));
        console.log(this.storeName);
      }
    },
    
  }



</script>

<style>

</style>