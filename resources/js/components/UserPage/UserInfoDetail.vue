<template>
    <v-container>
        <v-row justify="center">
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
        <v-row justify="center">
            <router-link to="/userpaymentform">
                <v-btn text >
                    カード登録画面へ
                </v-btn>
            </router-link>

            <v-btn color="success" @click="itemPaid">
                購入
            </v-btn>
            
            

        </v-row>
    </v-container>
</template>

<script>
export default {
    data: () => ({
        userData:'',
        cardData:''
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
                this.cardData = response.data.defaultCard;
            })
            .catch(error => console.log(error));
        },
        itemPaid(){
            axios.post('/user/paid')
            .then(response => {
                console.log(response.data);
            })
            .catch(error => console.log(error));
        }
    },
}
</script>



<style>

</style>