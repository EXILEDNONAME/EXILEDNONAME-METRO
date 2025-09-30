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
        /^kt-/
      ],
      defaultExtractor: (content) => content.match(/[\w-/:]+(?<!:)/g) || []
    })
  ]
};