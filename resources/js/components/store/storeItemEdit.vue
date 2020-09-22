<template>
     <transition name="modal" appear>
    <div class="modal-overlay" @click.self="$emit('close')" style="color:black" > 
        
            <v-text-field
                label="商品名"
                placeholder="カレー"
                outlined
                v-model="updateItemName"
                
            >
            <!-- :error-messages="itemNameErrors"
                required
                @input="$v.item_name.$touch()"
                @blur="$v.item_name.$touch()" -->
            </v-text-field>
<!-- v-if="view" -->
            <label >写真を追加して下さい
                <input type="file" @change="imageEdit"  >
            </label>
            <p v-if="editedImage">
                <img class="img" :src="editedImage" />
            </p>
            <!-- 画像のプレビュー機能 -->
            <!-- <img
                    v-show="uploadedImage"
                    class="preview-item-file"
                    :src="uploadedImage"
                    alt=""
                /> -->
            

            <v-text-field
                label="値段"
                placeholder="100円"
                outlined
                v-model="updatePrice"
                
            >
            <!-- :error-messages="itemPriceErrors"
                required
                @input="$v.price.$touch()"
                @blur="$v.price.$touch()" -->
            </v-text-field>

            <v-text-field
                label="商品状況"
                placeholder="売り切れ"
                outlined
                v-model="updateItemStatus"
                
            >
            <!-- :error-messages="itemStatusErrors"
                required
                @input="$v.item_status.$touch()"
                @blur="$v.item_status.$touch()" -->
            </v-text-field>
            <button @click="updateStoreItem(updateId, updateItemName, updatePrice, updateItemStatus, file)" >追加</button>
            <button @click="$emit('close')">閉じる</button>
       <p>{{message}}</p>
    </div>

    </transition>
    
</template>



<script>
  export default {
    name: 'Modal',
    props: ['val'],
    data() {
        return {
            editedImage:"",
            updateId: "",
            updateItemName: "",
            updatePrice: "",
            updateItemStatus: "",
            updateItemImage: "",
            file:"",
            message:"",
            // updateForm:false,
        };
    },
    mounted(){
        const vm = this;
            Vue.nextTick(function () {
                console.log(vm.val);
            });
        console.log(this.val)
        this.updateId = this.val.id
        this.updateItemName = this.val.item_name
        this.updatePrice = this.val.price
        this.updateItemImage = this.val.item_image
        this.updateItemStatus = this.val.item_status
        
    },
    methods:{
        updateStoreItem(updateId, updateItemName, updatePrice, updateItemStatus, file){
            
            let EditData = new FormData();
            EditData.append("id", this.updateId);
            EditData.append("item_name", this.updateItemName);
            EditData.append("file", this.file);
            EditData.append("price", this.updatePrice);
            EditData.append("item_status", this.updateItemStatus);
axios
                .patch("/api/StoreItems/" + updateId, {
                    item_name: this.updateItemName,
                    price: this.updatePrice,
                    item_status: this.updateItemStatus,
                    item_image: this.file
                })
                .then(response => {
                    // this.getStoreItem();
                    // this.isPush = false;
                    // this.updateForm = false;
                    console.log(response.data);
                    this.message = "";
                })
                .catch(err => {
                    this.message = err;
                });
        },
            //  axios({
            //     // POSTを指定する
            //                 method: 'POST',
            //     // APIのURLを指定
            //                 url: 'http://127.0.0.1:8000/api/StoreItems/'+updateId,
            //                 headers: {
            //     // ファイルを送れるようmultipart/form-datを指定する
            //                     'Content-Type': 'multipart/form-data',
            //     // ここでPUTに置き換える
            //                     'X-HTTP-Method-Override': 'PUT',
            //                 },
            //     // ファイルが入ったデータ
            //                 data: EditData,
            //             })
                
            //     .then(response => {
            //         // this.getStoreItem();
            //         // this.isPush = false;
            //         // this.updateForm = false;
            //         this.message = "";
            //     })
            //     .catch(err => {
            //         this.message = err;
            //     });
            // },
        imageEdit(e) {
            this.message = "";
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                this.message = "画像ファイルを選択して下さい";
                this.editedImage = "";
                return;
            }
            this.createEditImage(this.file);
        },

        createEditImage(file) {
            //FileReaderのインスタンスを作成しfileを読み込む
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = e => {
                this.editedImage = e.target.result;
            };
        },
        
        
        
        

        }
}

</script>
