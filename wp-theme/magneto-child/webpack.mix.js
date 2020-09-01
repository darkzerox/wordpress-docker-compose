let mix = require('laravel-mix')
require('laravel-mix-clean-css')
require('laravel-mix-imagemin')
require('laravel-mix-postcss-config')
require('laravel-mix-purgecss')
require('laravel-mix-definitions')

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

// let cssIn = "assets/styles/main.scss";
let cssOut = 'public/styles/'

// let jsIn = "assets/scripts/main.js";
let jsOut = 'public/scripts/'

let imgIn = 'assets/images/'
let imgOut = 'public/images/'

// let scssOption = {
//   precision: 5,
//   sourceMap: true,
//   outputStyle: "compressed",
// };

mix.definition({
  $: 'jQuery',
  _: 'lodash',
})

mix
  /**
   * * compile js
   */
  .js('assets/scripts/main.js', jsOut)
  .js('assets/scripts/archive.js', jsOut)
  .js('assets/scripts/home.js', jsOut)
  .js('assets/scripts/page.js', jsOut)
  .js('assets/scripts/single.js', jsOut)

  /**
   * * compile scss
   */
  //Gutenberg Editor Style
  .sass('assets/styles/commons/gutenberg-editor-styles.scss', cssOut)

  // wordpress structure
  .sass('assets/styles/main.scss', cssOut)
  .sass('assets/styles/partials/archive.scss', cssOut)
  .sass('assets/styles/partials/home.scss', cssOut)
  .sass('assets/styles/partials/single.scss', cssOut)
  .sass('assets/styles/partials/page.scss', cssOut)

  // .postCss('assets/vendor/bulma.css', cssOut + '/bulma.css', [
  //   require('postcss-import'),
  //   require('cssnano')({
  //     preset: 'default',
  //   }),
  // ])

  /**
   * * add css prefix option
   * * add css custom variable
   */
  .options({
    processCssUrls: false,
    postCss: [
      require('postcss-custom-properties'),
      require('autoprefixer'),
      require('postcss-object-fit-images'),
      // require('cssnano')({
      //   preset: 'default',
      // }),
    ],
  })
  /**
   * !remove unuse css //remove bootstrap!!!!
   */
  // .purgeCss()

  /**
   * * clean-css on all stylesheets
   * * Beautify only in dev mode
   */
  // .cleanCss({
  //   level: 2,
  //   format: mix.inProduction() ? false : 'beautify',
  // })

  // copy font
  .copy('assets/fonts/', 'public/fonts/')

  //copy img
  .copy(imgIn, imgOut)

/**
 * * optimize image
 */
// .imagemin([
//   {
//     from: imgIn,
//     to: imgOut,
//   },
// ]);

// mix.webpackConfig({
//   externals: {
//     jquery: 'jQuery',
//   },
// })