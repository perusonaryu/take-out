<template>
  <v-app-bar
    color="#ffd700"
    elevate-on-scroll
    scroll-target="#scrolling-techniques-7"
    fixed
    height="64px"
  >
    <v-toolbar-title class="txt-color">
      <router-link to="/">
        Pick Up
      </router-link>
    </v-toolbar-title>

    <v-spacer></v-spacer>

    <!-- <router-link to="/userinfotop">picksについて</router-link> -->

    <!-- <router-link to="/register">アカウントを作成</router-link> -->
    <!-- <router-link to="/login">
      <v-btn class="btn-font" color="white" outlined  > ログイン </v-btn>
    </router-link> -->
    <slot></slot>
  </v-app-bar>
</template>

<script>
export default {
  data: () => ({}),
};
</script>

<style scoped>
a {
  text-decoration: none;
  color: white !important;
}

.v-toolbar__content a + a {
  margin: 0 20px;
}

.v-toolbar {
  background-color: rgba(0, 0, 0, 0);
}

.txt-color {
  color: white;
  font-weight: bold;
  font-size: 25px;
}
</style>

<style>
button:focus {
	outline:0;
}
</style>