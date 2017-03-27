const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

elixir((mix) => {
    mix.sass('app.scss')
       .webpack('app.js')
        .scripts('layoutPartner.js')
       .sass('style.scss');
    mix.sass('partners/style.scss', 'public/css/partners/style.css');
       // .scripts('layoutAdmin.js');
    // mix.scripts('helpers/*.js', 'public/js/helpers/helpers.js');
    // mix.copy('resources/assets/bowers/font-awesome/css/font-awesome.min.css', 'public/bowers/font-awesome/css/font-awesome.min.css');
    // mix.copy('resources/assets/bowers/font-awesome/fonts/', 'public/bowers/font-awesome/fonts/');
    //
    // mix.copy('resources/assets/bowers/jquery/dist/jquery.min.js', 'public/bowers/jquery/dist/jquery.min.js')
    //    .copy('resources/assets/bowers/bootstrap/', 'public/bowers/bootstrap/');
    // mix.copy('resources/assets/bowers/jquery/dist/jquery.min.js', 'public/bowers/jquery/dist/jquery.min.js');
    // mix.copy('resources/assets/bowers/bootstrap/dist/css/bootstrap.min.css', 'public/bowers/bootstrap/dist/css/bootstrap.min.css');
    // mix.copy('resources/assets/bowers/sweetalert/dist/sweetalert-dev.js', 'public/js/sweetalert-dev.js');
    // mix.copy('resources/assets/bowers/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css');
    // mix.copy('resources/assets/bowers/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js');
    // mix.copy('resources/assets/bowers/sweetalert', 'public/sweetalert');
mix.copy('resources/assets/js/partners/all.js', 'public/js/partners/all.js');
});
