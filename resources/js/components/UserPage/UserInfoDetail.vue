<template>
  <div class="user-info-detail">
    <Header />
    <div class="uid-wrapper" >
      <h1 style="text-align:center;">お客様情報</h1>
      <div class="userinfo-card">
        <div>{{ userData.name }}</div>
        <div>{{ userData.email }}</div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => ({
    userData: '',
  }),
  mounted() {
    this.getUserData();
  },

  methods: {
    getUserData() {
      axios
        .get('/user')
        .then(res => {
          this.userData = res.data;
        })
        .catch(err => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
.user-info-detail {
  margin-top: 64px;
  height: 100%;
}

.uid-wrapper {
  height: 100%;
  margin-top: 150px;
}

.userinfo-card {
  width: 300px;
  margin: 30px auto;
  text-align: center;
  font-weight: bold;
  font-size: 20px;
}
</style>
