const mix = require("laravel-mix");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js("resources/js/app.js", "public/js")
    .vue()
    .sass("resources/sass/app.scss", "public/css")
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
} else {
    // Only run browser sync on dev
    const { hostname } = new URL(process.env.APP_URL);
    mix.browserSync("0.0.0.0:8000").options({
        hmrOptions: {
            host: hostname,
            port: "8080",
        },
    });
}
