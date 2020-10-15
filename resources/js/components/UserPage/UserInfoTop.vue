<template>
<div class="d-flex align-items-center justify-content-center" style="height:600px;">
<table class="table" style="width:300px;">
  <tr><td>アイコン</td><td>お客様情報</td></tr>
  <tr><td>アイコン</td><td>カード情報</td></tr>
  <tr><td>アイコン</td><td>注文履歴</td></tr>
</table>
</div>
</template>

<script>
export default {
    data: () => ({
        // userData:'',
    }),
    // mounted(){

    // },

    // methods:{
    //     getUserData(){
    //         axios.get('/user/payment')
    //         .then(response => {
    //             consol.log(response.data);
    //         })
    //         .catch(error => console.log(error));
    //     }
    // },
}
</script>



<style scoped>
table{
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
}

table tr{
  border-bottom: solid 1px #eee;
  cursor: pointer;
}

table tr:hover{
  background-color: #FFD700;
}

table th,table td{
  text-align: center;
  width: 25%;
  padding: 15px 0;
}



</style>