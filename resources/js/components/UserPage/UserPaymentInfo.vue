<template>
<div class="payment-info">
    <Header/>
    <div class="payinfo-wrapper">
        <v-row justify="center" v-if ="cardJudg == true">
            <h1>現在登録しているクレジットカード</h1>
            <v-col md="8">
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
            </v-col>
        </v-row>
        <v-row justify="center" v-else-if="cardJudg === false">
            <h1>現在登録しているクレジットカードはありません</h1>
        </v-row>
        <v-row justify="space-around">
            <router-link to="/userpaymentform">
                <v-btn text >
                    カードの変更
                </v-btn>
            </router-link>

            <router-link to="/Confirm">
                <v-btn color="success" >
                    購入画面へ
                </v-btn>
            </router-link>
        </v-row>
            <v-btn color="primary" @click="logout">
                ログアウト
            </v-btn>
    </div>
</div>
</template>

<script>
export default {
    data: () => ({
        userData:'',
        cardData:'',
        cardJudg:'',
    }),
    mounted(){
        this.getUserData();
    },

    methods:{
          getUserData(){
            axios.get('/user/payment')
            .then(response => {
                console.log(response.data);
                this.userData = response.data.user;
                if(response.data.defaultCard == null){
                    this.cardJudg = false;
                }else{
                    this.cardData = response.data.defaultCard;
                    this.cardJudg = true;
                }
            })
            .catch(error => console.log(error));
        },
        // itemPaid(){
        //     axios.post('/user/paid')
        //     .then(response => {
        //         console.log(response.data);
        //     })
        //     .catch(error => console.log(error));
        // },
        logout(){
            axios.post('/logout').then(()=>{
                this.$router.push({ name: "login"})
            })
        }
    },
}
</script>



<style>
.payment-info{
  margin-top: 64px;
}
.payinfo-wrapper{
  margin-top: 150px;
}
</style>