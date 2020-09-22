<template>
<div class="card-body">
    <form  class="card-form" id="form_payment" method="POST">
        
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
            <input type="text" name="cardName" id="cardName" class="form-control" value="" placeholder="カード名義を入力">
        </div>
        <div class="form-group">
            <button @click="submit" id="create_token" class="btn btn-primary">カードを登録する</button>
        </div>
        <div v-if="show_result">{{result_message}}</div>
    </form>
    <!-- <a href="{{route('user.payment')}}">クレジットカード情報ページに戻る</a> -->
</div>
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

</style>
