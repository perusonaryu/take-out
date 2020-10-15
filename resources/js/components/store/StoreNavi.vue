<template>
   <v-col md="3" style="text-align: center" class="navi">
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

}
</script>

<style>
.button2 {
  text-align: center;
  align-items: center;
  border: solid 5px #ffd700;
  font-size: 18px;
  color: black;
  width: 120px;
  border-radius: 20px;
  margin: 50px auto;
  line-height: 50px;
}
.button {
  text-decoration: none !important;
}
</style>