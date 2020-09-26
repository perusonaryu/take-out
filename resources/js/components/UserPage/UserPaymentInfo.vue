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
      <td>{{ cardinfo.number }}</td>
    </tr>
    <th >カードブランド</th>
      <td>{{ cardinfo.brand }}</td>
    <tr>
      <th >名義</th>
      <td>{{ cardinfo.name }}</td>
    </tr>
    <th >有効期限</th>
      <td>{{ cardinfo.exp_month }}/{{ cardinfo.exp_year }}</td>
  </tbody>
</table>
</template>
<script>
export default {
    data(){
        return{
            cardinfo: "",
            // number:"",
            // brand:"",
            // name:"",
            // month:"",
            // year:"",
        }
    },
    
    mounted: function() {
        this.getCardInfo();
        
    },
    methods: {
        getCardInfo() {
            axios
                .get("/user/payment")
                .then(response => {
                    this.cardinfo = response.data.defaultCard;
                    // this.number = this.cardinfo.number;
                    // this.brand = this.cardinfo.brand;
                    // this.name = this.cardinfo.name;
                    // this.month = this.cardinfo.exp_month
                    // this.year = this.cardinfo.exp_year;
                    // console.log(response.data);
                    console.log(response.data);
                    console.log(response.data.defaultCard);
                })
                .catch(err => {
                    // this.message = err;
                    console.log(err);
                });
        },
    }
}


</script>