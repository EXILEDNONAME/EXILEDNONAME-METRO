import cssnano from "cssnano";
import purgecssPlugin from "@fullhuman/postcss-purgecss";

export default {
  plugins: [
    cssnano({ preset: "default" }),
    purgecssPlugin.default({
      content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./public/**/*.html"
      ],
      // safelist: [/.*/],
      safelist: [
        /^alert/,
        /^align-/,
        /^bg-/,
        /^aside-minimize/,
        /^btn/,
        /^card/,
        /^col-/,
        /^collapse/,
        /^container/,
        /^d-/,
        /^dropdown/,
        /^fade/,
        /^flex/,
        /^justify-/,
        /^modal/,
        /^offcanvas/,
        /^row$/,
        /^text-/,
        /^show/,
        /^tooltip/,
        /^tooltip-inner$/,
        /^arrow$/,
        /^bs-tooltip-top/,
        /^menu-item$/,
        /^menu-item-submenu$/,
        /^menu-item-open$/,
        /^menu-item-active$/,
        /^menu-link$/,
        /^menu-toggle$/,
        /^menu-submenu$/,
        /^menu-subnav$/,
        /^menu-arrow$/,
        /^menu-text$/,
        /^menu-bullet$/,
        /^menu-bullet-dot$/,
        /^paginate_button/,
        /^dataTables_paginate/,
        /^paging_simple_numbers/,
        /^dataTables_wrapper/,
        /^dt-bootstrap4/,
        /^no-footer/,
        /^page-item/,
        /^page-link/,
        /^previous/,
        /^pagination/,
        /^next/,
        /^disabled/,
        /^ki-/,
        
        // Bootstrap table
    /^table/,
    /^table-sm/,
    /^table-bordered/,
    /^table-striped/,
    /^table-hover/,
    /^table-responsive/,
    /^table-head-custom/,
    /^table-checkable/,
    /^table-separate/,
        /^dataTable/,
        /^selected/,
        /^odd/,
        /^even/,
        /^td/,
        /^th/,
        /^tbody/,
        
        
        

        /^kt-/
      ],
      defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || []
    })
  ]
};