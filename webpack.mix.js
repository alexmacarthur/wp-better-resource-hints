const fs = require('fs');
const mix = require('laravel-mix');
const BabiliPlugin = require('babili-webpack-plugin');

/*
 |--------------------------------------------------------------------------
 | Custom Webpack Config
 |--------------------------------------------------------------------------
 */

mix.webpackConfig({
  plugins: [new BabiliPlugin()]
});

/*
 |--------------------------------------------------------------------------
 | Custom Mix Options
 |--------------------------------------------------------------------------
 */

mix.options({
  processCssUrls: false,
  uglify: false,
  postCss: [
    require('autoprefixer')({
      browsers: ['last 5 versions']
    })
  ]
});

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 */

mix
  .sass('src/assets/scss/style.scss', 'src/assets/css/style.css')
  .js('src/assets/js/scripts.js', 'src/assets/js/scripts.min.js')
  .js('src/assets/js/preload.js', 'src/assets/js/preload.min.js')
