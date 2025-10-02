// jQuery
import $ from "jquery";
window.$ = window.jQuery = $;

// Bootstrap 4
import "bootstrap";

// Popper.js
import Popper from "popper.js";
window.Popper = Popper;

// Toastr
import toastr from "toastr";
window.toastr = toastr;

// Perfect Scrollbar
import PerfectScrollbar from "perfect-scrollbar";
window.PerfectScrollbar = PerfectScrollbar;

// Tooltip init
$(function () {
  $('[data-toggle="tooltip"]').tooltip();
});