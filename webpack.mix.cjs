const mix = require("laravel-mix");

mix.browserSync({
    proxy: 'http://localhost:8000',
    files: [
        'app/**/*.php',
        'resources/views/**/*.blade.php',
    ],
    open: false,
    notify: false,
    ui: false,
    injectChanges: true
});

// mix.js("resources/js/metronic/components/app.js", "mix/js/plugins.bundle.min.js");

mix.js("resources/js/metronic/plugins.js", "public/mix/js/plugins.bundle.js");