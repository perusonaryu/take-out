<template>
  <v-col md="3" style="text-align: center" class="navi">
    <v-btn text @click.prevent="logout" class="button2" style="background-color:#ffd700;"> ログアウト </v-btn>
    <router-link to="/storepage" class="button d-flex align-center justify-center">
      <div class="button2">ホーム</div>
    </router-link>
    <router-link to="/OrderHistory" class="button d-flex align-center justify-center">
      <div class="button2">注文履歴</div>
    </router-link>
    <router-link to="/OrderComplete" class="button d-flex align-center justify-center">
      <div class="button2">注文完了履歴</div>
    </router-link>
  </v-col>
</template>

<script>
export default {

  methods:{
      logout() {
      axios.post('/storeusers/logout').then(() => {
        this.$router.push({ name: 'storeLogin' });
      });
    },
  }
};
</script>

<style>
.button2 {
  text-align: center;
  align-items: center;
  border: solid 5px #ffd700;
  font-size: 18px;
  font-weight: bold;
  color: black;
  width: 120px;
  border-radius: 20px;
  margin: 50px auto;
  line-height: 50px;
  box-shadow: 0 10px 25px 0 rgba(0, 0, 0, 0.2);
}
.button {
  text-decoration: none !important;
}
</style>
