import axios from 'axios';

import i18n from '@/plugins/i18n';

import Response from '@/classes';

import {loadProgressBar} from 'axios-progress-bar';

import 'axios-progress-bar/dist/nprogress.css';

import store from '@/store';

import navigatorLanguage from '@/plugins/navigatorLanguage';

loadProgressBar();

function makeResponse(data) {
    if (data.response) {
        data = data.response;
    }

    if (data.message === 'Network Error') {
        store.dispatch('setToast', {text: i18n.tc('toast.error_server')});
    }
    console.log(data);
    return new Response(data);
}

axios.defaults.baseURL = process.env.VUE_APP_URL_BASE + process.env.VUE_APP_URL_RESOURCE;
console.log(axios.defaults.baseURL);
axios.defaults.headers.common.Authorization = `Bearer ${localStorage.getItem(process.env.VUE_APP_TOKEN_JWT)}`;
axios.defaults.headers.common.Accept = 'application/json';
axios.defaults.headers.common['Accept-Language'] = navigatorLanguage;

axios.interceptors.response.use(data => Promise.resolve(makeResponse(data)), makeResponse);
