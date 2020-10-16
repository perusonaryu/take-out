<template>
  <v-col md="3" style="text-align: center" class="navi">
    <v-row justify="center" align="center">
      <v-col md="4">
        <v-btn text @click.prevent="logout" class="button2" style="background-color:#ffd700;">
          ログアウト
        </v-btn>
        <div class="button2">
          <router-link to="/storepage" class="button d-flex align-center justify-center">
            ホーム
          </router-link>
        </div>
        <div class="button2">
          <router-link to="/OrderHistory" class="button d-flex align-center justify-center">
            注文履歴
          </router-link>
        </div>
        <div class="button2">
          <router-link to="/OrderComplete" class="button d-flex align-center justify-center">
            注文完了履歴
          </router-link>
        </div>
      </v-col>
    </v-row>
  </v-col>
</template>

<script>
export default {
  methods: {
    logout() {
      axios.post('/storeusers/logout').then(() => {
        this.$router.push({ name: 'storeLogin' });
      });
    },
  },
};
</script>

<style scoped>
a{
  color: black!important;
}
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
