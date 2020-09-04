<template>
  <form>
      <h1 class="d-flex justify-center">StoreCreate</h1>
    <v-text-field
      v-model="storeName"
      :error-messages="storeNameErrors"
      label="storeName"
      required
      @input="$v.storeName.$touch()"
      @blur="$v.storeName.$touch()"
    ></v-text-field>
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
    <!-- <v-select
      v-model="select"
      :items="items"
      :error-messages="selectErrors"
      label="Item"
      required
      @change="$v.select.$touch()"
      @blur="$v.select.$touch()"
    ></v-select>
    <v-checkbox
      v-model="checkbox"
      :error-messages="checkboxErrors"
      label="Do you agree?"
      required
      @change="$v.checkbox.$touch()"
      @blur="$v.checkbox.$touch()"
    ></v-checkbox> -->

    <v-btn class="mr-4" @click="storeAdd">create</v-btn>
    <v-btn @click="clear">clear</v-btn>
  </form>
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

    methods: {
      storeAdd () {
        this.$v.$touch();
        axios.post('/storeCreate',{
            storeName: this.storeName,
            address: this.address,
            introduction: this.introduction,
            category: this.category
        })
        .then(response => alert(response.data.message))
        .catch(error => console.log(error));
      },
      clear () {
        this.$v.$reset()
        this.name = ''
        this.email = ''
      },
    },
  }
</script>

<style>

</style>