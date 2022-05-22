/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/main.js ***!
  \******************************/


{
  $(function () {
    // ハンバーガーメニュー
    $(".hamburger").on("click", function () {
      $(this).toggleClass("active");

      if ($(this).hasClass("active")) {
        $(".sp-menu--nav").addClass("active");
      } else {
        $(".sp-menu--nav").removeClass("active");
      }
    }); // moreボタン

    var hiddenParts = $(".news-parts--hidden");
    var btn = $(".news-btn");
    btn.on("click", function () {
      hiddenParts.addClass("open");
    }); // ニュースフェードイン

    $(window).on("scroll", function () {
      $(".news-parts").each(function () {
        var windowHeight = $(window).height();
        var scroll = $(window).scrollTop();
        var targetPosition = $(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          $(this).addClass("appear");
        }
      });
    });
    $(window).on("scroll", function () {
      $(".fade").each(function () {
        var windowHeight = $(window).height();
        var scroll = $(window).scrollTop();
        var targetPosition = $(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          $(this).addClass("in");
        }
      });
    }); // 時間差フェードイン

    $(window).on("scroll", function () {
      $(".time-fade").each(function (i) {
        var windowHeight = $(window).height();
        var scroll = $(window).scrollTop();
        var targetPosition = $(this).offset().top;

        if (scroll >= targetPosition - windowHeight) {
          var delay = 400;
          $(this).delay(i * delay).queue(function () {
            $(this).addClass("in");
          });
        }
      });
    });
  });
}
/******/ })()
;