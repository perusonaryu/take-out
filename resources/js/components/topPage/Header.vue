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

    <v-menu offset-y v-if="authJudg">
      <template v-slot:activator="{ on, attrs }">
        <v-btn color="white" text outlined v-bind="attrs" v-on="on">
          {{ userName }}さん
          <v-icon>mdi-chevron-down</v-icon>
        </v-btn>
      </template>

      <v-list color="#ffd700">
        <v-list-item>
          <v-list-item-title class="d-flex justify-center">
            <router-link to="/userinfotop">
              <v-btn class="btn-font" color="white" outlined>
                マイページ
              </v-btn>
            </router-link>
          </v-list-item-title>
        </v-list-item>
        <v-list-item>
          <v-list-item-title class="d-flex justify-center">
            <v-btn class="btn-font" color="white" outlined @click="logout">
              ログアウト
            </v-btn>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
    <router-link to="/login">
      <v-btn v-if="authJudg == false" class="btn-font" color="white" outlined >
        ログイン
      </v-btn>
    </router-link>

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
        this.$router.push({ path: '/' });
        this.authJudg = false;
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
