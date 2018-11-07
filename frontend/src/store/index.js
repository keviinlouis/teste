import Vue from 'vue';
import Vuex from 'vuex';
import axios from 'axios';
import i18n from '@/plugins/i18n';

import store from './store';

import auth from './auth';
import employees from './employees';

Vue.use(Vuex);

function removeCommonHeaders() {
  delete axios.defaults.headers.common.Authorization;
}

function addCommonHeaders() {
  axios.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem(process.env.VUE_APP_TOKEN_JWT)}`;
}

export default new Vuex.Store({
  modules: {
    auth,
    employees,
  },
  state: store,
  getters: {
    getToast(state) {
      return state.toast;
    },
    getAllStatus(state) {
      let status = state.status;
      status.push({value: 0, text: i18n.tc('status.all')});
      return status;
    },
  },
  actions: {
    setToast({ commit }, toast) {
      this.state.toast.text = toast.text;
      this.state.toast.show = true;
    },
    closeToast() {
      this.state.toast.show = false;
    },
  },
});
