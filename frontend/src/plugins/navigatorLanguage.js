function findLanguage(language) {
  const locales = require.context('@/locales', true, /[A-Za-z0-9-_,\s]+\.json/i);

  let locale = null;

  locales.keys()
    .forEach((key) => {
      const clearedKey = key.replace('./', '').replace('.json', '').toLowerCase();
      const clearedLanguage = language.replace('-', ' ').toLowerCase();
      const match = clearedLanguage.match(clearedKey.replace('_', ' '));
      if (match !== null) {
        locale = clearedKey;
      }
    });
  if (!locale) {
    return 'pt_br';
  }

  return locale;
}

let lang = window.navigator.languages ? window.navigator.languages[0] : null;
lang = lang || window.navigator.language || window.navigator.browserLanguage || window.navigator.userLanguage;

export default findLanguage(lang);

