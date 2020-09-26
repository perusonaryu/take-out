<template>
    <v-app-bar
      color="white"
      elevate-on-scroll
      scroll-target="#scrolling-techniques-7"
      fixed
    >


      <v-toolbar-title>Title</v-toolbar-title>

      <v-spacer></v-spacer>

      <router-link to="/userinfotop">picksについて</router-link>
      <router-link to="/dashboard">飲食店登録</router-link>
      <router-link to="/dashboard">picksについて</router-link>
      
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
  color:black!important;
}

.v-toolbar__content a + a{
  margin-left:10px;
}

.v-toolbar{
  background-color: rgba(0, 0, 0, 0);
}

</style>