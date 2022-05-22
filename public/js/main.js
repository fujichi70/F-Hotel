/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/


{
  window.addEventListener('DOMContentLoaded', function () {
    // ハンバーガーメニュー
    jQuery(".hamburger").on("click", function () {
      jQuery(this).toggleClass("active");

      if (jQuery(this).hasClass("active")) {
        jQuery(".sp-menu--nav").addClass("active");
      } else {
        jQuery(".sp-menu--nav").removeClass("active");
      }
    });
    jQuery(".news-btn").on("click", function () {
      jQuery(".news-parts--hidden").addClass("open");
    }); // ニュースフェードイン

    jQuery(window).on("scroll", function () {
      jQuery(".news-parts").each(function () {
        var windowHeight = jQuery(window).height();
        var scroll = jQuery(window).scrollTop();
        var targetPosition = jQuery(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          jQuery(this).addClass("appear");
        }
      });
    });
    jQuery(window).on("scroll", function () {
      jQuery(".fade").each(function () {
        var windowHeight = jQuery(window).height();
        var scroll = jQuery(window).scrollTop();
        var targetPosition = jQuery(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          jQuery(this).addClass("in");
        }
      });
    }); // 時間差フェードイン

    jQuery(window).on("scroll", function () {
      jQuery(".time-fade").each(function (i) {
        var windowHeight = jQuery(window).height();
        var scroll = jQuery(window).scrollTop();
        var targetPosition = jQuery(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          var delay = 400;
          jQuery(this).delay(i * delay).queue(function () {
            jQuery(this).addClass("in");
          });
        }
      });
    });
  });
}
/******/ })()
;