<template>
<v-container>
  <div class="cart">
    <h1>注文詳細</h1>
    <ul v-for="item in cartItems" :key="item.id">
        <span>
            <input type="text" >
            {{item.itemName}} 
        </span>
        <span>
            <input type="text" >
            {{item.price}}円
        </span>
        <span>
            <input type="text" >
            {{item.quantity}}個
        </span>
    </ul>
    <p>合計金額： {{cartTotalPrice}}(税込み)</p>
    </div>

    <div class="card">
        <ul class="list-group">
            <li class="list-group-item">
                <span>カード番号： </span>
                {{cardData.number}}
            </li>
            <li class="list-group-item">
                <span>カード有効期限(月/年)：</span>
                {{cardData.exp_month}}/{{cardData.exp_year}}
            </li>
            <li class="list-group-item">
                <span>カード名義：</span>
                {{cardData.name}}
            </li>
            <li class="list-group-item">
                <span>カードブランド：</span>
                {{cardData.brand}}
            </li>
        </ul>
    </div>

    <label>受け取り時間
        <input type="text" v-model="PickUpTime">
    </label>

    <div>
        <button type="button" @click="postConfirmData">決済へ</button>
    </div>

    <button @click="logout">logout</button>

</v-container>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
    data(){
        return{
            cardData:"",
            PickUpTime:"",
        }
    },
    computed:{
        ...mapGetters(['cartItems','cartTotalPrice'])
            
        },
    mounted(){
        this.getCardData();
        
        

    },
    created(){
        
        
    },
    methods:{
        getCardData(){
            axios.get('/user/payment')
            .then(response => {
                // console.log(response.data);
                // this.userData = response.data.user;
                this.cardData = response.data.defaultCard;
            })
            .catch(error => {
                this.$router.push({ name: "userpaymentform"})          
            });
        },
        postConfirmData(){
            // console.log(this.cartItems[0].itemName);
            // console.log(this.cartTotalPrice);
            // console.log(this.PickUpTime);
            let ItemInfo = [this.cartItems[0].itemName,this.cartItems[0].price,this.cartItems[0].quantity]
            let data = new FormData();
            data.append("item_info", ItemInfo);
            data.append("item_total_price", this.cartTotalPrice);
            data.append("pickup_date_time", this.PickUpTime);
            data.append("store_id",this.$store.state.storeId);
            axios.post("/storebuy", data)
            .then(response => {
                this.notification(this.$store.state.storeId);
                
            })
            .catch(err => {
                this.message = err;
            });     
        },

        notification(id){
            axios.get('/sent/' + id)
            .then(response => {
                console.log("サクセス");
                this.$router.push({ name: "Settle"});
            })
            .catch(error => console.log(error))
        },
        logout(){
            axios.post('/logout').then(()=>{
                this.$router.push({ name: "login"})
            })
        }

        

    
    },
}
</script>

<style>

</style>