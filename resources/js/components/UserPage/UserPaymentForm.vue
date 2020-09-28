<template>
    <v-container>
        <div class="form-group">
            <label for="name">カード番号</label>
            <div id="cardNumber"></div>
        </div>

        <div class="form-group">
            <label for="name">セキュリティコード</label>
            <div id="securityCode"></div>
        </div>

        <div class="form-group">
            <label for="name">有効期限</label>
            <div id="expiration"></div>
        </div>

        <div class="form-group">
            <label for="name">カード名義</label>
            <!-- <input type="text" name="cardName" id="cardName" class="form-control" value="" placeholder="カード名義を入力">
        </div> -->
        <!-- <div class="form-group">
            <button @click="submit" id="create_token" class="btn btn-primary">カードを登録する</button>
        </div>
        <div v-if="show_result">{{result_message}}</div>
    </form> -->
    <!-- <a href="{{route('user.payment')}}">クレジットカード情報ページに戻る</a> -->
<!-- </div>
</template>


<script>
export default {
    data() {
        return {
        cardNumber: null,
        stripe: Stripe("pk_test_51HTcy3LNe3F5SGnQS3KhJx0L2sJsExG6RpslBaBSNSQALEV0Owxs8RI0ex5ZorikXXEeFP2do2ggJLDUuTwVPjEe00GeQ23J0r"),
        show_result: false,
        result_message: "",
        
        };
        
    },

     mounted() {
        const elements = this.stripe.elements();
        this.cardNumber = elements.create('cardNumber');
        this.cardNumber.mount('#cardNumber');
        const cardCvc = elements.create('cardCvc');
        cardCvc.mount('#securityCode');
        const cardExpiry = elements.create('cardExpiry');
        cardExpiry.mount('#expiration');
    },
    
    methods: {
        submit(e){
            // let stripeToken="";
            const self = this;
            self.show_result = false;
            e.preventDefault();
            this.stripe.createToken(this.cardNumber,{name: document.querySelector('#cardName').value}).then(result => {
                if (result.error) {
                    alert("カード登録処理時にエラーが発生しました。カード番号が正しいものかどうかをご確認いただくか、別のクレジットカードで登録してみてください。");
                } else {
                    console.log(result.token.id);
                    let token =  result.token.id;
                    // let data = new FormData();
                    // data.append("stripeToken",token);
                    // stripeTokenHandler(result.token);
                    self.show_result = true;
                    self.result_message = "token_id: " + result.token.id;

                    axios.post('/user/payment/store',{stripeToken:token})
                        .then(response => {
                            // console.log(stripeToken.token);
                            console.log(response);
                            // console.log(response.data);
                        })
                        .catch(err => {
                            console.log(err);
                            // console.log(err.data);
                        });
                        }
                // return stripeToken
            });
            
            // console.log(stripeToken);
            // axios.post('/user/payment/store',stripeToken)
            // .then(response => {
            //         console.log(stripeToken);
            //         console.log(response);
            //         console.log(response.data);
            //     })
            //     .catch(err => {
            //         console.log(err);
            //         console.log(err.data);
            //     });
    //         function stripeTokenHandler(token) {
    //         const form = document.getElementById('form_payment');
    //         const hiddenInput = document.createElement('input');
    //         hiddenInput.setAttribute('type', 'hidden');
    //         hiddenInput.setAttribute('name', 'stripeToken');
    //         hiddenInput.setAttribute('value', token.id);
    //         form.appendChild(hiddenInput);

    //         form.submit();
    // }
        }
    }
    
};
</script>

<style>

</style> -->
            <input type="text" name="cardName" id="cardName" class="form-control" v-model="name" placeholder="カード名義を入力">
        </div>
        <div class="form-group">
            <button type="button" @click="submit" id="create_token" class="btn btn-primary">カードを登録する</button>
        </div>
    <router-link to="/userinfodetail">クレジットカード情報ページに戻る</router-link>

    </v-container>
</template>

<script>
// var stripe = Stripe('pk_test_51HSFBBF9GRw3obPkIX51VQ8SeexFhz1bUOGMqwVAVhf12FIVEJsn3QEWFs96HEiWZzIB9Isb5I4iucRaYhcKhcKU008JCCHxIF');
// var elements = stripe.elements();

export default {
    data: () =>({
        // card: null,
        stripe: Stripe("pk_test_51HSFBBF9GRw3obPkIX51VQ8SeexFhz1bUOGMqwVAVhf12FIVEJsn3QEWFs96HEiWZzIB9Isb5I4iucRaYhcKhcKU008JCCHxIF"),
        // show_result: false,
        // result_message: "",
        name:'',
        cardNumber:null,
        stripeToken:'',
    }),

    mounted() {
        const elements = this.stripe.elements();
        const style = {
            base: {
                fontSize: '12px',
                color: "#32325d",
                // border: "solid 1px ccc"
            }
        };
        /* フォームでdivタグになっている部分をStripe Elementsを使ってフォームに変換 */
        this.cardNumber = elements.create('cardNumber', {style:style});
        this.cardNumber.mount('#cardNumber');

        const cardCvc = elements.create('cardCvc', {style:style});
        cardCvc.mount('#securityCode');

        const cardExpiry = elements.create('cardExpiry', {style:style});
        cardExpiry.mount('#expiration');

    },

    methods:{
        submit() {
            // const self = this;
            // self.show_result = false;
            // this.stripe.createToken(this.card).then(result => {
            //     console.log("result: " + JSON.stringify(result));
            //     // エラーの場合
            //     if (result.error) {
            //     self.show_result = true;
            //     self.result_message = result.error.message;
            //     // 成功の場合
            //     } else {
            //     self.show_result = true;
            //     self.result_message = "token_id: " + result.token.id;
            //     }
            // });

            const self = this;
            /* Stripe.jsを使って、フォームに入力されたコードをStripe側に送信。今回ご紹介している方法の場合、「カード名義」だけはStripe Elementsの仕組みを使っていないため、このままだとカード名義の情報が足りずにカード情報の暗号化ができなくなってしまうので、{name:document.querySelector('#cardName').value}を足すことで、フォームに入力されたカード名義情報も、他の情報と同時にStripeに送ることができるようになる。 */
            this.stripe.createToken(this.cardNumber,{name: this.name}).then(function(result) {
                /* errorが返ってきた場合はその旨を表示 */
                if (result.error) {
                    alert("カード登録処理時にエラーが発生しました。カード番号が正しいものかどうかをご確認いただくか、別のクレジットカードで登録してみてください。");
                } else {

                    /* 暗号化されたコードが返ってきた場合は以下のStripeTokenHandler関数を実行。その際、引数として暗号化されたコードを渡してあげる。 */
                    // stripeTokenHandler(result.token);
                    self.stripeToken = result.token.id;
                    console.log(result.token);
                    axios.post('/user/payment/store',{
                        stripeToken:self.stripeToken,
                    })
                    .then(response=>{
                        console.log(response);
                    })
                    .catch(error => console.log(error));
                }
            });

        }
    }
}
</script>



<style>

</style>
