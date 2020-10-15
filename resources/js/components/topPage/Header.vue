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
    <div v-if="authJudg" class="d-flex align-center">
      <h5 class="mr-5 text-white mb-0">{{ userName }}さん</h5>
      <v-btn  class="btn-font" color="white" outlined @click="logout">
        ログアウト
      </v-btn>
    </div>

    <slot></slot>
  </v-app-bar>
</template>

<script>
export default {
  data: () => ({
    userName: '',
    authJudg: false,
  }),
  created() {
    this.auth();
  },
  methods: {
    auth() {
      axios
        .get('/athenticated')
        .then(response => {
          axios.get('/user').then(response => {
            // console.log(response.data);
            this.userName = response.data.name;
            this.authJudg = !this.authJudg;
          });
        })
        .catch(error => {
          this.authJudg = false;
        });
    },
    logout() {
      axios.post('/logout').then(() => {
        this.$router.push({ name: 'topPage' });
      });
    },
  },
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
  outline: 0;
}
</style>
