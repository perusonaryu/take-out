<template>
  <v-container>
    <v-row justify="center" align="center" class="login-form">
      <v-col md="7" cols="12" class="login-text">
        <v-card class="card" outlined>
          <v-list-item-title class="title"> Login </v-list-item-title>
          <v-text-field
            v-model="login.email"
            :error-messages="emailErrors"
            label="メールアドレス"
            required
            outlined
            color="#ffd700"
            append-icon="mdi-email"
            @input="$v.login.email.$touch()"
            @blur="$v.login.email.$touch()"
          ></v-text-field>

          <v-text-field
            v-model="login.password"
            :error-messages="passwordErrors"
            label="パスワード"
            type="password"
            outlined
            required
            color="#ffd700"
            append-icon="mdi-lock"
            @input="$v.login.password.$touch()"
            @blur="$v.login.password.$touch()"
          ></v-text-field>

          <div class="d-flex justify-space-between">
            <v-btn class="btn-font" @click="loginUser" color="#ffd700" text x-large> ログイン </v-btn>

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
    login: {
      email: { required, email },
      password: { required },
    },
  },

  data() {
    return {
      login: {
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
      if (!this.$v.login.password.$dirty) return errors;
      !this.$v.login.password.required && errors.push('パスワードを入力してください');
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.login.email.$dirty) return errors;
      !this.$v.login.email.email && errors.push('メールアドレスの形式が違います');
      !this.$v.login.email.required && errors.push('メールアドレスを入力してください');
      return errors;
    },
  },

  methods: {
    loginUser() {
      axios
        .post('/login', this.login)
        .then(() => {
          (response) => console.log(response.data);

          this.$router.push({ name: 'Confirm' });
        })
        .catch((error) => {
          console.log(error);
          this.errors = error.response.data.errors;
        });
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