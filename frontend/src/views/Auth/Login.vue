<template>
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-card-text>
                                <v-form data-vv-scope="login" @submit.prevent="login">
                                    <v-layout align-center justify-center column fill-height class="logo">
                                        <img src="@/assets/logo.png" alt="">
                                    </v-layout>
                                    <v-text-field prepend-icon="email"
                                                  name="email"
                                                  autofocus
                                                  :label="$t('label.email')"
                                                  v-model="form.email"
                                                  v-validate="'required|email'"
                                                  :error-messages="errors.first('login.email')"
                                                  @keyup.enter="login"
                                                  type="email">
                                    </v-text-field>
                                    <v-text-field id="password"
                                                  prepend-icon="lock"
                                                  name="password"
                                                  :label="$t('label.password')"
                                                  v-model="form.password"
                                                  v-validate="'required|min:6'"
                                                  :error-messages="errors.first('login.password')"
                                                  @keyup.enter="login"
                                                  :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                  @click:append="showPassword = !showPassword"
                                                  :type="showPassword ? 'text' : 'password'">
                                    </v-text-field>
                                </v-form>
                                <v-layout align-center justify-center column fill-height style="padding:0 10%">
                                    <v-btn color="primary"
                                           depressed
                                           @click.stop="login"
                                           :loading="loading"
                                           :disabled="loading">
                                        {{$t('btn.login')}}
                                    </v-btn>
                                    <v-btn color="primary"
                                           depressed
                                           outline
                                           :to="{name: 'sign-up'}">
                                        {{$t('btn.sign_up')}}
                                    </v-btn>
                                </v-layout>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</template>

<script>

export default {
  name: 'Login',
  data() {
    return {
      form: {
        email: '',
        password: '',
      },
      loading: false,
      showPassword: false,
    };
  },
  methods: {
    async validateLoginForm() {
      const isValid = await this.$validator.validateAll('login');

      this.loading = isValid;

      return isValid;
    },

    async sendLoginForm() {
      return await this.$store.dispatch('auth/login', this.form);
    },

    async login() {
      if (!await this.validateLoginForm()) {
        return;
      }
      this.handleResponse(await this.sendLoginForm(), 'login', () => this.$router.push({ name: 'employees' }));

      this.loading = false;
    },
  },
};
</script>

<style scoped>
    .v-btn {
        width: 100%;
        padding: 0;
    }

    .logo {
        padding: 5%;
    }

    .logo img {
        width: 70%;
    }
</style>
