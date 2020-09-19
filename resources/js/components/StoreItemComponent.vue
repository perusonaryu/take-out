<template>
    <div>
        <!-- 新規追加フォーム -->
        <div>
            <p>商品名<input type="text" v-model="item_name" /></p>
            <p>値段<input type="text" v-model="price" /></p>
            <p>在庫<input type="text" v-model="item_status" /></p>
            <p>画像<input type="file" @change="confirmImage" v-if="view" /></p>
            <!-- 確認用画像 -->
            <p v-if="confirmedImage">
                <img class="img" :src="confirmedImage" />
            </p>
            <button @click="addStoreItem">追加</button>
        </div>
 
        <!-- 商品一覧 -->
        <div>
            <div class="menu-modal" v-for="storeitem in storeitems" :key="storeitem.id" style="width:100px; height:330px">
                <div class="img-wrapper">
                    <img :src="`${storeitem.item_image}`" alt="商品の画像です" style="width:100%; height:150px">
                </div>
                <div class="item-detail-section" style="width:100%; height:150px text-align:center;">
                    <div class="item-name" style="width:100px; height:50px">
                        {{ storeitem.item_name }}
                    </div>
                    <div class="item-price" style="width:100px; height:50px">
                        {{ storeitem.price}}
                    </div>
                    <div class="item-status" style="width:100px; height:50px">
                        {{ storeitem.item_status}}
                    </div>
                </div>
                    <div class="button-section">
                        <button :disabled="isPush" type="button"
                            @click="displayUpdate(storeitem.id, storeitem.item_name, storeitem.price,storeitem.item_status, storeitem.item_image)"
                        >
                            編集
                        </button>
                        <button :disabled="isPush" @click="deleteStoreItem(storeitem.id)" type="button">
                            削除
                        </button>
                    </div>
                    
            </div>
            <!-- <ul>
                <li v-for="storeitem in storeitems" :key="storeitem.id">
                    {{ storeitem.id }}/{{ storeitem.item_name }}/{{ storeitem.price }}/{{ storeitem.item_status }}/{{ storeitem.item_image }}
                    <button
                        :disabled="isPush"
                        @click="displayUpdate(storeitem.id, storeitem.item_name, storeitem.price,storeitem.item_status, storeitem.item_image)"
                    >
                        編集
                    </button>
                    <button :disabled="isPush" @click="deleteStoreItem(storeitem.id)">
                        削除
                    </button>
                </li>
            </ul> -->
        </div>
 
        <!-- 編集フォーム -->
        <!-- <div v-if="updateForm">
            <p>idが{{ updateId }}の編集フォーム</p>
            <p>商品名<input type="text" v-model="updateItemName" /></p>
            <p>値段<input type="text" v-model="updatePrice" /></p>
            <p>在庫<input type="text" v-model="updateItemStatus" /></p>
            <p>画像<input type="text" v-model="updateItemImage" /></p>
            <button @click="updateStoreItem(updateId, updateItemName, updatePrice,updateItemStatus, updateItemImage)">
                編集する
            </button>
            <button @click="updateCancel">キャンセル</button>
        </div> -->
 
        <!-- エラーメッセージ -->
       
        <p v-if="message">{{ message }}</p>
    </div>
</template>
 
<script>
export default {
    data() {
        return {
            message: "",
            file: "",
            view: true,
            isPush: false,
            updateForm: false,
            storeitems: {},
            confirmedImage: "",
            item_name: "",
            item_status: "",
            price: "",
            // item_image: "",
            updateId: "",
            updateItemName: "",
            updatePrice: "",
            updateItemStatus: "",
            updateItemImage: ""
        };
    },
    created: function() {
        this.getStoreItem();
        
    },
    methods: {
        getStoreItem() {
            axios
                .get("/api/StoreItems/")
                .then(response => {
                    this.storeitems = response.data;
                    console.log(response.data);
                })
                .catch(err => {
                    this.message = err;
                });
        },
        addStoreItem() {
            //Laravel側のapiへPOSTするデータとしてFormData オブジェクトを利用
            let data = new FormData();
            data.append("item_name", this.item_name);
            data.append("file", this.file);
            data.append("price", this.price);
            data.append("item_status", this.item_status);
            
            axios
                .post("/api/StoreItems/", data)
                .then(response => {
                    this.getStoreItem();
                    this.message = response.data.success;
                    this.confirmedImage = "";
                    this.item_name = "";
                    this.price = "";
                    this.file = "";
                    this.item_status = "";
                    
                    //ファイルを選択のクリア
                    this.view = false;
                    this.$nextTick(function() {
                        this.view = true;
                    });
                })
                .catch(err => {
                    this.message = err.response.data.errors;
                });
                console.log(renponse.data)
        },
        //読み込んだファイルの情報を取得 画像ファイルかどうかを判定
        confirmImage(e) {
            this.message = "";
            this.file = e.target.files[0];
            if (!this.file.type.match("image.*")) {
                this.message = "画像ファイルを選択して下さい";
                this.confirmedImage = "";
                return;
            }
            this.createImage(this.file);
        },
        createImage(file) {
            //FileReaderのインスタンスを作成しfileを読み込む
            let reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = e => {
                this.confirmedImage = e.target.result;
            };
        },
        displayUpdate(id, item_name, price,item_status, item_image) {
            this.isPush = true;
            this.updateForm = true;
            this.message = "";
            this.updateId = id;
            this.updateItemName = item_name;
            this.updatePrice = price;
            this.updateItemStatus = item_status;
            this.updateItemImage = item_image;
        },
        updateCancel() {
            this.isPush = false;
            this.updateForm = false;
            this.message = "";
        },
        updateStoreItem(updateId, updateItemName, updatePrice, updateItemStatus, updateItemImage) {
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
        },
        deleteStoreItem(id) {
            axios
                .delete("/api/StoreItems/" + id)
                .then(response => {
                    this.getStoreItem();
                    this.message = "";
                })
                .catch(err => {
                    this.message = err;
                });
        }
    }
};
</script>