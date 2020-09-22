<template>
  <table class="table" >
  <thead > 
    <tr >
      <!-- scope="col" -->
      <th >登録されているカード</th>
    </tr>
  </thead>
  <tbody >
    <tr >
      <!-- scope="row" -->
      <th >カード番号</th>
      <td>{{ card.number }}</td>
    </tr>
    <th >カードブランド</th>
      <td>{{ card.brand }}</td>
    <tr>
      <th >名義</th>
      <td>{{ card.name }}</td>
    </tr>
    <th >有効期限</th>
      <td>{{ card.exp_month }}/{{ card.exp_year }}</td>
  </tbody>
</table>
</template>
<script>
export default {
    data(){
        return{
            cardinfo: {},
        }
    },
    
    created: function() {
        this.getCardInfo();
        
    },
    methods: {
        getCardInfo() {
            axios
                .get("/user/payment")
                .then(response => {
                    this.cardinfo = response.data;
                    // console.log(response.data);
                    console.log(this.card.brand);
                })
                .catch(err => {
                    // this.message = err;
                    console.log(err);
                });
        },
    }
}


</script>