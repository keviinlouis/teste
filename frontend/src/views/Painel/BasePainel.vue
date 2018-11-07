<template>
    <v-app>
        <v-navigation-drawer
                v-model="drawer"
                :width="200"
                fixed
                app
                class="primary"
        >
            <v-list two-line>
                <v-list-tile class="logo logo-max">
                    <img src="@/assets/logo.png" alt="logo"/>
                </v-list-tile>

                <v-list-tile v-for="(menu, i) in menus"
                             :key="i"
                             :to="{name: menu.route}"
                             active-class="dark"
                             exact
                             class="item">
                    <v-layout align-center
                              justify-center
                              column
                              fill-height>
                        <v-icon
                                class="mb-2">
                            {{menu.icon}}
                        </v-icon>
                        <div>
                            {{menu.name}}
                        </div>
                    </v-layout>
                </v-list-tile>

            </v-list>
        </v-navigation-drawer>
        <v-toolbar app color="default" dark>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-spacer></v-spacer>
            <v-toolbar-title v-text="user.name"></v-toolbar-title>
            <v-btn icon @click.stop="logout">
                <v-icon>fa fa-sign-out-alt</v-icon>
            </v-btn>
        </v-toolbar>
        <v-content>
            <v-slide-x-transition mode="out-in">
                <router-view/>
            </v-slide-x-transition>
        </v-content>
    </v-app>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
  name: 'BasePage',
  computed: {
    ...mapGetters({
      user: 'auth/getUser',
    }),
  },
  methods: {
    logout() {
      this.$store.dispatch('auth/logout').finally(() => this.$router.push({ name: 'login' }));
    },
  },
  data() {
    return {
      drawer: true,
      menus: [
        {
          icon: 'dashboard',
          name: this.$t('sidebar.employees'),
          route: 'employees',
        },
      ],
    };
  },
};
</script>

<style scoped>
    .logo-max {
        padding-left: 60px;
    }

    .logo-min {
        padding-left: 0;
    }

    .logo {
        margin-top: -9px;
        height: 64px;
    }

    .logo img {
        height: 50px;
        width: 50px;
        margin-bottom: 4px;
    }
</style>
