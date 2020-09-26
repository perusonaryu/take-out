<template>
<div class="modal" id="itemeditmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form enctype="multipart/form-data">
            <h1 class="d-flex justify-center">商品編集</h1>
             <label>商品画像
                <input type="file" @change="itemImageEdit" name="itemimage"
>
            </label>
            <p v-if="editedImage" style="width:100px;height:200px;">
                <img class="img" :src="editedImage" style="width:100%;"/>
            </p>
            <v-text-field
            v-model="updateItemName"
            label="商品名"
            
            >  </v-text-field>
            <v-text-field
            v-model="updatePrice"
            label="値段"
            
            ></v-text-field>
            <v-text-field
            v-model="updateItemStatus"
            label="商品状況"
            
            ></v-text-field>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal" @click="updateStoreItem(updateId)" >編集する</button>
      </div>
      </form>
      </div>
  </div>
</div>

            <!-- </v-text-field>
            <button @click="updateStoreItem(updateId, updateItemName, updatePrice, updateItemStatus, file)" >追加</button>
            <button @click="$emit('close')">閉じる</button>
       <p>{{message}}</p>
    </div>

    </transition> -->
    
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
           
            file:"",
            
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
        this.file = this.val.item_image
        this.updateItemStatus = this.val.item_status
        
    },
    methods:{
        updateStoreItem(updateId){
            
            let editedData = new FormData();
            editedData.append("id", this.updateId);
            editedData.append("item_name", this.updateItemName);
            editedData.append("file", this.file);
            editedData.append("price", this.updatePrice);
            editedData.append("item_status", this.updateItemStatus);
            console.log(...editedData.entries());
axios
                .post("/api/StoreItems/" + this.updateId,editedData,
                {
          headers: {
            'X-HTTP-Method-Override': 'PUT'
          }
        })
                .then(response => {
                    // this.getStoreItem();
                    // this.isPush = false;
                    // this.updateForm = false;
                    console.log(response.data);
                    this.$emit('itemUpdate');
                })
                .catch(err => {
                    console.log(err);
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
                
        itemImageEdit(e) {
            
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                
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
