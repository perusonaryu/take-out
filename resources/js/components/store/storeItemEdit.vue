<template>
     <transition name="modal" appear>
    <div class="modal-overlay" @click.self="$emit('close')">
        <form style="color:black">
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

            <label >写真を追加して下さい
                <input type="file" value=updateItemImage>
            </label>
            <!-- 画像のプレビュー機能 -->
            <!-- <img
                    v-show="uploadedImage"
                    class="preview-item-file"
                    :src="uploadedImage"
                    alt=""
                /> -->
            <!-- @change="confirmImage"  v-if="view"-->

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
            <button @click="updateStoreItem">追加</button>
            <button @click="$emit('close')">閉じる</button>
        </form>
    </div>
    </transition>
</template>



<script>
  export default {
    name: 'Modal',
    props: ['val'],
    data() {
        return {
            
            updateId: "",
            updateItemName: "",
            updatePrice: "",
            updateItemStatus: "",
            updateItemImage: "",
        };
    },
    mounted(){
        const vm = this;
            Vue.nextTick(function () {
                console.log(vm.val);
            });
        console.log(this.val)
        this.updateId = this.val.store_id
        this.updateItemName = this.val.item_name
        this.updatePrice = this.val.price
        this.updateItemImage = this.val.item_image
        this.updateItemStatus = this.val.item_status
        
    },
    methods:{
        updateStoreItem(updateId, updateItemName, updatePrice, updateItemStatus, updateItemImage){
            axios
                .put("/api/StoreItems/" + updateId, {
                    item_name: this.updateItemName,
                    price: this.updatePrice,
                    item_status: this.updateItemStatus,
                    item_image: this.updateItemImage
                })
                .then(response => {
                    this.getStoreItem();
                    this.isPush = false;
                    this.updateForm = false;
                    this.message = "";
                })
                .catch(err => {
                    this.message = err;
                });
            }
        

        }
}

</script>