<template>
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <v-card class="elevation-12">
                            <v-card-text>
                                <v-form data-vv-scope="sign-up" @submit.prevent="signUp">
                                    <v-layout align-center justify-center column fill-height class="logo">
                                        <img src="@/assets/logo.png" alt="">
                                    </v-layout>
                                    <v-text-field prepend-icon="people"
                                                  name="name"
                                                  autofocus
                                                  :label="$t('label.name')"
                                                  v-model="form.name"
                                                  v-validate="'required|min:3'"
                                                  :error-messages="errors.first('sign-up.name')"
                                                  @keyup.enter="signUp"
                                                  type="text">
                                    </v-text-field>
                                    <v-text-field prepend-icon="email"
                                                  name="email"
                                                  autofocus
                                                  :label="$t('label.email')"
                                                  v-model="form.email"
                                                  v-validate="'required|email'"
                                                  :error-messages="errors.first('sign-up.email')"
                                                  @keyup.enter="signUp"
                                                  type="email">
                                    </v-text-field>
                                    <v-text-field id="password"
                                                  prepend-icon="lock"
                                                  name="password"
                                                  ref="password"
                                                  :label="$t('label.password')"
                                                  v-model="form.password"
                                                  v-validate="'required|min:6'"
                                                  :error-messages="errors.first('sign-up.password')"
                                                  @keyup.enter="signUp"
                                                  :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                  @click:append="showPassword = !showPassword"
                                                  :type="showPassword ? 'text' : 'password'">
                                    </v-text-field>
                                    <v-text-field id="password_confirmation"
                                                  prepend-icon="lock"
                                                  name="password_confirmation"

                                                  :label="$t('label.password_confirmation')"
                                                  v-model="form.password_confirmation"
                                                  v-validate="'required|min:6|confirmed:password'"
                                                  :error-messages="errors.first('sign-up.password_confirmation')"
                                                  @keyup.enter="signUp"
                                                  :append-icon="showPassword ? 'visibility_off' : 'visibility'"
                                                  @click:append="showPassword = !showPassword"
                                                  :type="showPassword ? 'text' : 'password'">
                                    </v-text-field>
                                </v-form>
                                <v-layout align-center justify-center column fill-height style="padding:0 10%">
                                    <v-btn color="primary"
                                           depressed
                                           @click.stop="signUp"
                                           :loading="loading"
                                           :disabled="loading">
                                        {{$t('btn.sign_up')}}
                                    </v-btn>
                                    <v-btn color="primary"
                                           depressed
                                           outline
                                           :to="{name: 'login'}">
                                        {{$t('btn.login')}}
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
        name: '',
        email: '',
        password: '',
      },
      loading: false,
      showPassword: false,
    };
  },
  methods: {
    async validateLoginForm() {
      const isValid = await this.$validator.validateAll('sign-up');

      this.loading = isValid;

      return isValid;
    },

    async sendSignUpForm() {
      return await this.$store.dispatch('auth/signUp', this.form);
    },

    async signUp() {
      if (!await this.validateLoginForm()) {
        return;
      }
      this.handleResponse(await this.sendSignUpForm(), 'sign-up', () => this.$router.push({ name: 'employees' }));

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
