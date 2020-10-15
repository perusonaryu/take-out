<template>
  <div class="container " style="display:flex;align-items:center;">
    <div class="link-box" style="">
      <router-link to="/UserInfoDetail" class="button d-flex align-center justify-center">
        <div class="link">お客様情報</div>
      </router-link>
      <router-link to="/userpaymentinfo" class="button d-flex align-center justify-center">
        <div class="link">カード情報</div>
      </router-link>
      <router-link to="/userorderhistory" class="button d-flex align-center justify-center">
        <div class="link">注文履歴</div>
      </router-link>
    </div>
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
};
</script>

<style scoped>
.link-box {
  background-color: #ffd700;
  width: 300px;
  height: 300px;
  margin: auto;
  border-radius: 20px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, .2);
}
.link {
  text-align: center;
  align-items: center;
  
  font-size: 18px;
  color: black;
  width: 120px;
  background-color: white;
  margin: 30px auto;
    border-radius: 20px;
    box-shadow: 0 10px 25px 0 rgba(0, 0, 0, .2);
}
</style>
