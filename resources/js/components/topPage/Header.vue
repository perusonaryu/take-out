<template>
    <v-app-bar
      color="#ffd700"
      elevate-on-scroll
      scroll-target="#scrolling-techniques-7"
      fixed
    >


      <v-toolbar-title>Pick Up</v-toolbar-title>

      <v-spacer></v-spacer>

      <!-- <router-link to="/userinfotop">picksについて</router-link> -->
      <router-link to="/register">アカウントを作成</router-link>
      <router-link to="/login">ログイン</router-link>
      
    </v-app-bar>
</template>

<script>
export default {
  data: () => ({
    
  })
    
}
</script>

<style scoped>
a{
  text-decoration:none;
  color:white!important;
}

.v-toolbar__content a + a{
  margin-left:10px;
}

.v-toolbar{
  background-color: rgba(0, 0, 0, 0);
}

</style>