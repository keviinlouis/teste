import Vue from 'vue';
import VueI18n from 'vue-i18n';
import moment from 'moment';
import navigatorLanguage from '@/plugins/navigatorLanguage';

Vue.use(VueI18n);

const locales = require.context('@/locales', true, /[A-Za-z0-9-_,\s]+\.json$/i);
const messages = {};
messages[navigatorLanguage] = locales(`./${navigatorLanguage}.json`);


const i18n = {
  locale: navigatorLanguage || process.env.VUE_APP_I18N_LOCALE || 'en',
  fallbackLocale: process.env.VUE_APP_I18N_FALLBACK_LOCALE || 'en',
  messages,
};

moment.locale(i18n.locale);

console.log(`Navigator Language: ${navigator.language}`);
console.log(`Lang for I18Nn: ${i18n.locale}`);

export default new VueI18n(i18n);
