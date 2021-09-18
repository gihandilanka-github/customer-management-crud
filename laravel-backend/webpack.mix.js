const path = require('path')
const fs = require('fs-extra')
const mix = require('laravel-mix')
const PrerenderSPAPlugin = require('prerender-spa-plugin')
if (mix.inProduction()) {
  require('laravel-mix-versionhash')
}
// require('laravel-mix-versionhash')
// const { BundleAnalyzerPlugin } = require('webpack-bundle-analyzer')

mix
  .js('resources/js/app.js', 'public/dist/js')
  .sass('resources/sass/app.scss', 'public/dist/css')

  .disableNotifications();

mix.styles([
    'resources/js/themes/argon/assets/css/nucleo-icons.css',
    'resources/js/themes/argon/assets/css/nucleo-svg.css',
    'resources/js/themes/argon/assets/css/font-awesome.css',
    'resources/js/themes/argon/assets/css/nucleo-svg.css',
    'resources/js/themes/argon/assets/css/argon-design-system.css',
    'resources/css/theme-custom.css',
], 'public/dist/css/all.css');

mix.combine([
    'resources/js/themes/argon/assets/js/plugins/perfect-scrollbar.jquery.min.js',
    'resources/js/themes/argon/assets/js/plugins/bootstrap-switch.js',
    'resources/js/themes/argon/assets/js/plugins/nouislider.min.js',
    'resources/js/themes/argon/assets/js/plugins/moment.min.js',
    'resources/js/themes/argon/assets/js/plugins/datetimepicker.js',
    'resources/js/themes/argon/assets/js/plugins/bootstrap-datepicker.min.js',
    'resources/js/themes/argon/assets/js/argon-design-system.min.js',
], 'public/dist/js/all.js');

if (mix.inProduction()) {
  mix
    // .extract() // Disabled until resolved: https://github.com/JeffreyWay/laravel-mix/issues/1889
    // .version() // Use `laravel-mix-versionhash` for the generating correct Laravel Mix manifest file.
    .versionHash()
} else {
  mix.sourceMaps()
}

mix.webpackConfig({
  plugins: [
    // new BundleAnalyzerPlugin()
      new PrerenderSPAPlugin({
          // Required - The path to the webpack-outputted app to prerender.
          staticDir: path.join(__dirname, 'dist'),
          // Required - Routes to render.
          routes: [ '/', '/generate-qr-code-online', '/download-libreoffice-cv-templates', '/contact-us'],
      })
  ],
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '~': path.join(__dirname, './resources/js')
    }
  },
  output: {
    chunkFilename: 'dist/js/[chunkhash].js',
    path: mix.config.hmr ? '/' : path.resolve(__dirname, './public/build')
  }
})

mix.then(() => {
  if (!mix.config.hmr) {
    process.nextTick(() => publishAseets())
  }
})

function publishAseets () {
  const publicDir = path.resolve(__dirname, './public')

  if (mix.inProduction()) {
    // fs.removeSync(path.join(publicDir, 'dist'))
  }

  fs.copySync(path.join(publicDir, 'build', 'dist'), path.join(publicDir, 'dist'))
  fs.removeSync(path.join(publicDir, 'build'))
}
