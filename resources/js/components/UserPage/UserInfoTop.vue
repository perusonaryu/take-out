<template>
  <div class="user-info-top" style="height:100%;">
    <Header />
    <div class="user-info-wrapper">
      <div class="link-box d-flex align-center justify-center">
        <div >
          <router-link to="/userinfodetail" class="button d-flex align-center justify-center link">
            <div >お客様情報</div>
          </router-link>
          <router-link to="/userpaymentinfo" class="button d-flex align-center justify-center link">
            <div >カード情報</div>
          </router-link>
          <router-link to="/userorderhistory" class="button d-flex align-center justify-center link">
            <div >注文履歴</div>
          </router-link>
        </div>
      </div>
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

  methods:{
      logout() {
      axios.post('/logout').then(() => {
        this.$router.push({ name: 'login' });
      });
    },
  },
};
</script>

<style scoped>
a{
  text-decoration: none;
}
.user-info-wrapper {
  height: 100%;
  display: flex;
  align-items: center;
}

.link-box {
  width: 300px;
  height: 300px;
  margin: auto;
  border-radius: 20px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.2);
  border: solid 2px #ffd700;
}
.link {
  text-align: center;
  align-items: center;
  font-weight: bold;
  font-size: 18px;
  color: white;
  width: 200px;
  height:60px;
  background-color: #ffd700;
  margin: 30px auto;
  border-radius: 20px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.2);
}

.user-info-top {
  margin-top: 64px;
}
</style>
