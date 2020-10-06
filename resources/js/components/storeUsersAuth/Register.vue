<template>
  <v-container>
    <v-row justify="center" align="center" class="login-form">
      <v-col md="7" cols="12" class="login-text">
        <v-card class="card" outlined>
          <v-list-item-title class="register-title"> アカウント作成 </v-list-item-title>
          <v-text-field
            v-model="storeRegister.name"
            :error-messages="nameErrors"
            label="店名"
            required
            outlined
            color="#ffd700"
            append-icon="mdi-storefront"
            @input="$v.storeRegister.name.$touch()"
            @blur="$v.storeRegister.name.$touch()"
          ></v-text-field>

          <v-text-field
            v-model="storeRegister.email"
            :error-messages="emailErrors"
            label="メールアドレス"
            required
            outlined
            color="#ffd700"
            append-icon="mdi-email"
            @input="$v.storeRegister.email.$touch()"
            @blur="$v.storeRegister.email.$touch()"
          ></v-text-field>

          <v-text-field
            v-model="storeRegister.password"
            :error-messages="passwordErrors"
            label="パスワード"
            type="password"
            outlined
            required
            color="#ffd700"
            append-icon="mdi-lock"
            @input="$v.storeRegister.password.$touch()"
            @blur="$v.storeRegister.password.$touch()"
          ></v-text-field>

          <v-text-field
            v-model="storeRegister.password_confirmation"
            :error-messages="password_confirmationErrors"
            label="パスワード"
            type="password"
            outlined
            required
            color="#ffd700"
            append-icon="mdi-lock"
            @input="$v.storeRegister.password_confirmation.$touch()"
            @blur="$v.storeRegister.password_confirmation.$touch()"
          ></v-text-field>

          <div class="d-flex justify-space-between">
            <v-btn class="btn-font" @click.prevent="registerStore" color="#ffd700" text x-large>
              サインアップ
            </v-btn>

            <router-link to="/storelogin">
              <v-btn class="btn-font" color="primary" text x-large> ログイン画面へ </v-btn>
            </router-link>
          </div>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { validationMixin } from 'vuelidate';
import { required, maxLength, minLength, email } from 'vuelidate/lib/validators';

export default {
  mixins: [validationMixin],

  validations: {
    storeRegister: {
      name: { required },
      email: { required, email },
      password: { required, minLength: minLength(8) },
      password_confirmation: { required, minLength: minLength(8) },
    },
  },
  data() {
    return {
      storeRegister: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
      errors: [],
    };
  },
  computed: {
    nameErrors() {
      const errors = [];
      // console.log(this.$v);
      if (!this.$v.storeRegister.name.$dirty) return errors;
      !this.$v.storeRegister.name.required && errors.push('店名を入力してください');
      return errors;
    },
    emailErrors() {
      const errors = [];
      if (!this.$v.storeRegister.email.$dirty) return errors;
      !this.$v.storeRegister.email.email && errors.push('メールアドレスの形式が違います');
      !this.$v.storeRegister.email.required && errors.push('メールアドレスを入力してください');
      return errors;
    },
    passwordErrors() {
      const errors = [];
      // console.log(this.$v);
      if (!this.$v.storeRegister.password.$dirty) return errors;
      !this.$v.storeRegister.password.minLength && errors.push('パスワードは8文字以上です');
      !this.$v.storeRegister.password.required && errors.push('パスワードを入力してください');
      return errors;
    },
    password_confirmationErrors() {
      const errors = [];
      // console.log(this.$v);
      if (!this.$v.storeRegister.password_confirmation.$dirty) return errors;
      !this.$v.storeRegister.password_confirmation.minLength &&
        errors.push('パスワードは8文字以上です');
      !this.$v.storeRegister.password_confirmation.required &&
        errors.push('確認用のパスワードを入力してください');
      return errors;
    },
  },
  methods: {
    registerStore() {
      axios
        .post('/storeusers/register', this.storeRegister)
        .then(() => {
          console.log('saved');
          this.$router.push({ name: 'storePage' });
        })
        .catch((error) => {
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

.register-title {
  font-size: 25px;
  border-bottom: 1px solid #ffd700;
  font-weight: bold;
  margin-bottom: 30px;
  padding-bottom: 30px;
}

.btn-font {
    font-size:20px;
}
</style>