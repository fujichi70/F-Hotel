"use strict";

{
    window.addEventListener("DOMContentLoaded", function () {
        // ハンバーガーメニュー
        $(".hamburger").on("click", function () {
            $(this).toggleClass("active");

            if ($(this).hasClass("active")) {
                $(".sp-menu--nav").addClass("active");
            } else {
                $(".sp-menu--nav").removeClass("active");
            }
        });

        $(".news-btn").on("click", function () {
            $(".news-parts--hidden").addClass("open");
        });

        // ニュースフェードイン
        $(window).on("scroll", function () {
            $(".news-parts").each(function () {
                let windowHeight = $(window).height();
                let scroll = $(window).scrollTop();
                let targetPosition = $(this).offset().top;
                if (scroll >= targetPosition - windowHeight) {
                    $(this).addClass("appear");
                }
            });
        });

        $(window).on("scroll", function () {
            $(".fade").each(function () {
                let windowHeight = $(window).height();
                let scroll = $(window).scrollTop();
                let targetPosition = $(this).offset().top;
                if (scroll >= targetPosition - windowHeight) {
                    $(this).addClass("in");
                }
            });
        });

        // 時間差フェードイン
        $(window).on("scroll", function () {
            $(".time-fade").each(function (i) {
                let windowHeight = $(window).height();
                let scroll = $(window).scrollTop();
                let targetPosition = $(this).offset().top;
                if (scroll >= targetPosition - windowHeight) {
                    let delay = 400;
                    $(this)
                        .delay(i * delay)
                        .queue(function () {
                            $(this).addClass("in");
                        });
                }
            });
        });

        // 満室時に選択できないよう親要素にhiddenクラス付与
        $("td:has(p.room-full)").addClass("hidden");

    });
}
