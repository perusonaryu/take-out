
<template>
<div class="modal" id="itemaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
            <h1 class="d-flex justify-center">商品追加</h1>
             <label>商品画像
                <input type="file" @change="itemImageSelect">
            </label>
            <p v-if="selectedImage" style="width:100px;height:200px;">
                <img class="img" :src="selectedImage" style="width:100%;"/>
            </p>
            <v-text-field
            v-model="StoreItemName"
            label="商品名"
            :error-messages="itemNameErrors"
            required
            @input="$v.StoreItemName.$touch()"
            @blur="$v.StoreItemName.$touch()"
            >  </v-text-field>
            <v-text-field
            v-model="Price"
            label="値段"
            :error-messages="itemPriceErrors"
            required
            @input="$v.Price.$touch()"
            @blur="$v.Price.$touch()"
            ></v-text-field>
            <v-text-field
            v-model="ItemStatus"
            label="商品状況"
            :error-messages="itemStatusErrors"
            required
            @input="$v.ItemStatus.$touch()"
            @blur="$v.ItemStatus.$touch()"
            ></v-text-field>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="button" class="btn btn-primary" @click="addStoreItem" >商品追加</button>
      </div>
      </form>
      </div>
  </div>
</div>
    
    <!-- <div class="modal-overlay" @click.self="$emit('close')"> -->
            <!-- 確認用画像 -->
            <!-- <p v-if="confirmedImage" style="width:100px;height:200px;">
                <img class="img" :src="confirmedImage" style="width:100%;"/>
            </p>
            <button @click="addStoreItem" type="button">追加</button>
            <button @click="$emit('close')">閉じる</button> -->

</template>

<script>
//vuelidate
import { validationMixin } from 'vuelidate'
import { required,} from 'vuelidate/lib/validators'


export default {

    mixins: [validationMixin],

    validations: {
      StoreItemName: { required },
    //   file: { required },
      Price:{required},
      ItemStatus: {required},

    },
    data:()=>( {
        
            StoreItemName: "",
            file: "",
            Price: "",
            ItemStatus: "",
            view: true,
            selectedImage:"",
    }),
    props:['id'],

    computed: {
      itemNameErrors () {
        const errors = []
        if (!this.$v.StoreItemName.$dirty) return errors
        !this.$v.StoreItemName.required && errors.push('商品名を入力して下さい')
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
        if (!this.$v.Price.$dirty) return errors
        !this.$v.Price.required && errors.push('値段を入力して下さい')
        return errors
      },
      itemStatusErrors () {
        const errors = []
        if (!this.$v.ItemStatus.$dirty) return errors
        !this.$v.ItemStatus.required && errors.push('商品状況を入力して下さい')
        return errors
      },
      
    },
    
    methods: {
    addStoreItem() {
            //Laravel側のapiへPOSTするデータとしてFormData オブジェクトを利用
            let data = new FormData();
            data.append("item_name", this.StoreItemName);
            data.append("file", this.file);
            data.append("price", this.Price);
            data.append("item_status", this.ItemStatus);
            data.append("store_id",this.id);
            const config = {
                    headers: {
                        'content-type': 'multipart/form-data'
                    }
                };
            axios
                .post("/api/StoreItems/", data, config)
                .then(response => {
                    // this.getStoreItem();
                    this.$emit('add');
                    this.StoreItemName = "";
                    this.file = "";
                    this.Price = "";
                    this.ItemStatus = "";
                    
                    ファイルを選択のクリア
                    this.view = false;
                    this.$nextTick(function() {
                        this.view = true;
                    });
                })
                .catch(err => {
                    this.message = err;
                });
         },

         itemImageSelect(e) {
            this.message = "";
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                this.message = "画像ファイルを選択して下さい";
                this.selectedImage = "";
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
    }
};
</script>
<style scoped>
.v-input{
  color:black!important;
}
</style>