const mix = require("laravel-mix");

mix.browserSync({
    proxy: 'http://localhost:8000',
    files: [
        'app/**/*.php',
        'resources/views/**/*.blade.php',
    ],
    open: false,
    notify: true,
    ui: false,
    injectChanges: true
});