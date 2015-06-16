var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

// gulpを叩くとapp.lessをコンパイルします
// という訳でschema.lessに差し替えます
// コンパイル後のファイルはpublish/css内にdistされます

elixir(function(mix) {
    // mix.less('app.less');
    mix.less('schema-ui/schema.less');
});
