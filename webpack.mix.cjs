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

mix.js("resources/js/metronic/plugins.js", "public/mix/js/plugins.js")
    .minify("public/mix/js/plugins.js");

mix.scripts([
    'node_modules/datatables.net/js/jquery.dataTables.js',
    'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
    'node_modules/datatables.net-autofill/js/dataTables.autoFill.min.js',
    'node_modules/datatables.net-autofill-bs4/js/autoFill.bootstrap4.min.js',
    'node_modules/jszip/dist/jszip.min.js',
    'node_modules/pdfmake/build/pdfmake.min.js',
    'node_modules/pdfmake/build/vfs_fonts.js',
    'node_modules/datatables.net-buttons/js/dataTables.buttons.min.js',
    'node_modules/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js',
    'node_modules/datatables.net-buttons/js/buttons.colVis.js',
    'node_modules/datatables.net-buttons/js/buttons.flash.js',
    'node_modules/datatables.net-buttons/js/buttons.html5.js',
    'node_modules/datatables.net-buttons/js/buttons.print.js',
    'node_modules/datatables.net-colreorder/js/dataTables.colReorder.min.js',
    'node_modules/datatables.net-fixedcolumns/js/dataTables.fixedColumns.min.js',
    'node_modules/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js',
    'node_modules/datatables.net-keytable/js/dataTables.keyTable.min.js',
    'node_modules/datatables.net-responsive/js/dataTables.responsive.min.js',
    'node_modules/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js',
    'node_modules/datatables.net-rowgroup/js/dataTables.rowGroup.min.js',
    'node_modules/datatables.net-rowreorder/js/dataTables.rowReorder.min.js',
    'node_modules/datatables.net-scroller/js/dataTables.scroller.min.js',
    'node_modules/datatables.net-select/js/dataTables.select.min.js',
], 'public/mix/js/datatable.js');