<template>
  <v-container>
    <v-row justify="center" align="center" class="login-form">
      <v-col md="7" cols="12" class="login-text">
        <v-card class="card" outlined>
          <v-list-item-title class="title"> Login </v-list-item-title>
          <v-text-field
            v-model="storeLogin.email"
            :error-messages="emailErrors"
            label="メールアドレス"
            required
            outlined
            color="#ffd700"
            append-icon="mdi-email"
            @input="$v.storeLogin.email.$touch()"
            @blur="$v.storeLogin.email.$touch()"
          ></v-text-field>

          <v-text-field
            v-model="storeLogin.password"
            :error-messages="passwordErrors"
            label="パスワード"
            type="password"
            outlined
            required
            color="#ffd700"
            append-icon="mdi-lock"
            @input="$v.storeLogin.password.$touch()"
            @blur="$v.storeLogin.password.$touch()"
          ></v-text-field>

          <div class="d-flex justify-space-between">
            <v-btn class="btn-font" @click="loginStore" color="#ffd700" text x-large> ログイン </v-btn>

            <router-link to="/register">
              <v-btn class="btn-font" color="primary" text x-large> 登録画面へ </v-btn>
            </router-link>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, email } from 'vuelidate/lib/validators';

export default {
  mixins: [validationMixin],

  validations: {
    storeLogin: {
      email: { required, email },
      password: { required },
    },
  },
  data() {
    return {
      storeLogin: {
        email: '',
        password: '',
      },
      errors: [],
      user: '',
    };
  },
  computed: {
    passwordErrors() {
      const errors = [];
      // console.log(this.$v);
      if (!this.$v.storeLogin.password.$dirty) return errors;
      !this.$v.storeLogin.password.required && errors.push('パスワードを入力してください');
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.storeLogin.email.$dirty) return errors;
      !this.$v.storeLogin.email.email && errors.push('メールアドレスの形式が違います');
      !this.$v.storeLogin.email.required && errors.push('メールアドレスを入力してください');
      return errors;
    },
  },
  methods: {
    loginStore() {
      //  axios.get('/sanctum/csrf-cookie').then(response => {
      // // ログイン処理…
      axios
        .post('/storeusers/login', this.storeLogin)
        .then(() => {
          //  response => console.log(response.data);
          this.$router.push({ name: 'storePage' });
          // axios.get('/api/storeusers/user')
          // .then(response=>{
          //     this.user = response.data;
          //     if(this.user.id == null){
          //         this.$router.push({ name: "storeadd"});
          //     }else{
          //         this.$router.push({ name: "dashboard"});
          //     }
          // })
          // .catch(error => console.log(error));
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response.data.errors;
        });
      // console.log('ok');
      // });
    },
  },
};
</script>

<style scoped>
a {
  text-decoration: none;
}

.login-form {
  height: 100vh;
}

.card {
  padding: 50px;
}

.title {
  font-size: 30px !important;
  border-bottom: 1px solid #ffd700;
  font-weight: bold;
  margin-bottom: 30px;
  padding-bottom: 30px;
}

.btn-font {
    font-size:20px;
}
</style>