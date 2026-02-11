let mix = require('laravel-mix');

const destJs = "public/frontend/assets/js/";

mix.combine(
    [
        "resources/js/frontend/jquerymask.js",
        "resources/js/frontend/registrasi.js",
        "resources/js/frontend/login.js",
    ],
    destJs + "app.js"
);

mix.js('resources/js/app.js', 'public/frontend/assets/js');
