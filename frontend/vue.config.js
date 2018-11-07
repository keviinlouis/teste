module.exports = {
  devServer: {
    port: 8080, // CHANGE YOUR PORT HERE!
    https: false,
    hotOnly: false,
  },

  outputDir:'../backend/public/vue',

  pluginOptions: {
    i18n: {
      locale: 'pt_br',
      fallbackLocale: 'pt_br',
      localeDir: 'locales',
      enableInSFC: true,
    },
  },

  pwa: {
    name: 'Polvo',
    assetsVersion: '0.4',
  },
};
