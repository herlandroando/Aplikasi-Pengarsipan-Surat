const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
// mix.override((config) => {
//     delete config.watchOptions;
// });

mix.js('resources/js/app.js', 'public/js').vue({
    extractStyles: true,
    globalStyles: false
}).postCss('resources/css/app.css', 'public/css', []).postCss('node_modules/remixicon/fonts/remixicon.css', 'public/css/icon.css').postCss('node_modules/vue-toastification/dist/index.css', 'public/css/toast.css');

mix.options({
    hmrOptions: {
        host: 'arsiplldikti.test',
        port: 8080
    }
})

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            // 'vue$': 'vue/dist/vue.esm.js',
            '@@': __dirname + '/resources/js'
        },
    },
})

// mix.options({
//     autoprefixer: { remove: false }
// });

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);
