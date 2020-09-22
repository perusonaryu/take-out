<template>
     <transition name="modal" appear>
    <div class="modal-overlay" @click.self="$emit('close')">
        <form enctype="multipart/form-data">
            <v-text-field
                label="商品名"
                placeholder="カレー"
                outlined
                v-model="item_name"
                :error-messages="itemNameErrors"
                required
                @input="$v.item_name.$touch()"
                @blur="$v.item_name.$touch()"
            >
            </v-text-field>
            <label >写真を追加して下さい
              <input type="file" v-on:change="fileSelected">
            </label>
            <!-- @change="confirmImage"  v-if="view"-->

            <v-text-field
                label="値段"
                placeholder="100円"
                outlined
                v-model="price"
                :error-messages="itemPriceErrors"
                required
                @input="$v.price.$touch()"
                @blur="$v.price.$touch()"
            >
            </v-text-field>

            <v-text-field
                label="商品状況"
                placeholder="売り切れ"
                outlined
                v-model="item_status"
                :error-messages="itemStatusErrors"
                required
                @input="$v.item_status.$touch()"
                @blur="$v.item_status.$touch()"
            >
            </v-text-field>
            <button @click="addStoreItem" type="button">追加</button>
            <button @click="$emit('close')">閉じる</button>
        </form>
    </div>
    </transition>
</template>

<script>
//vuelidate
import { validationMixin } from 'vuelidate'
import { required,} from 'vuelidate/lib/validators'


export default {

    mixins: [validationMixin],

    validations: {
      item_name: { required },
    //   file: { required },
      price:{required},
      item_status: {required},

    },
    data:()=>( {
        
      item_name: "",
      file: "",
      price: "",
      item_status: "",
        
    }),

    computed: {
      itemNameErrors () {
        const errors = []
        if (!this.$v.item_name.$dirty) return errors
        !this.$v.item_name.required && errors.push('商品名を入力して下さい')
        return errors
      },
    //   fileErrors () {
    //     const errors = []
    //     if (!this.$v.file.$dirty) return errors
    //     !this.$v.file.required && errors.push('address is required')
    //     return errors
    //   },
      itemPriceErrors () {
        const errors = []
        if (!this.$v.price.$dirty) return errors
        !this.$v.price.required && errors.push('値段を入力して下さい')
        return errors
      },
      itemStatusErrors () {
        const errors = []
        if (!this.$v.item_status.$dirty) return errors
        !this.$v.item_status.required && errors.push('商品状況を入力して下さい')
        return errors
      },
      
    },
    
    methods: {
    addStoreItem() {
      //Laravel側のapiへPOSTするデータとしてFormData オブジェクトを利用
      let data = new FormData();
      data.append("item_name", this.item_name);
      data.append("file", this.file);
      data.append("price", this.price);
      data.append("item_status", this.item_status);
      axios
          .post("/api/StoreItems", data)
          .then(response => {
              // this.getStoreItem();
              this.message = response.data.success;
              // this.confirmedImage = "";
              this.item_name = "";
              this.file = "";
              this.price = "";
              this.item_status = "";
              
              //ファイルを選択のクリア
              // this.view = false;
              // this.$nextTick(function() {
              //     this.view = true;
              // });
              console.log('OK');
          })
          .catch(err => {
              this.message = err.response.data.errors;
          });
    },

    fileSelected(event){
        // console.log(event.target.files[0]);
        // this.imageInfo = event.__ob__.value[0];
        // this.imageInfo = event[0];
        this.file = event.target.files[0];
        // console.log(event);

    },
  }
};
</script>