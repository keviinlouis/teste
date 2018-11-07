import Vue from 'vue';
import Vuetify from 'vuetify';

import 'vuetify/dist/vuetify.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

Vue.use(Vuetify, {
  theme: {
      primary: "#AB47BC",
      secondary: "#7B1FA2",
      accent: "#F4511E",
      error: "#D50000",
      warning: "#ffeb3b",
      info: "#2196f3",
      success: "#4caf50"
  },
});
