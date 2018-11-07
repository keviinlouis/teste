import Vue from 'vue';
import i18n from '@/plugins/i18n';
import VeeValidate, { Validator } from 'vee-validate';
import navigatorLanguage from '@/plugins/navigatorLanguage';

function findLanguage(locales, language) {
  let locale = null;

  locales.keys()
    .forEach((key) => {
      const clearedKey = key.replace('./', '').replace('.js', '').toLowerCase();
      const clearedLanguage = language.replace('-', ' ').toLowerCase();

      const match = clearedLanguage.match(clearedKey.replace('_', ' '));

      if (match !== null) {
        locale = clearedKey;
      }
    });

  if (!locale) {
    return 'pt_BR';
  }

  return locale;
}

function getLocaleAttributes(navigatorLanguage) {
  const locale = require(`@/locales/${navigatorLanguage}.json`);

  return locale.label;
}

const locales = require.context('vee-validate/dist/locale', true, /[A-Za-z0-9-_,\s]+\.js/i);

const localeName = findLanguage(locales, navigatorLanguage);

const localeFile = `./${localeName}.js`;

console.log(`Vee-Validator Lang: ${localeName}`);

const locale = locales(localeFile);

locale.attributes = getLocaleAttributes(navigatorLanguage);
console.log(localeName, locale);

// Validator.localize(localeName, locale);

Vue.use(VeeValidate, { locale: localeName });
