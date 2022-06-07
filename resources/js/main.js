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

        // 日付選択時の非同期通信
    //     $(".day").on("click", function () {
    //         $(".table tbody").empty();

    //         let date = $(".day").val();

    //         if (!date) {
    //             return false;
    //         }

    //         $.ajax({
    //             headers: {
    //                 "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
    //                     "content"
    //                 ),
    //             },
    //             type: "POST",
    //             url: "/reservation/" + date, //後述するweb.phpのURLと同じ形にする
    //             date: date, //ここはサーバーに贈りたい情報。今回は検索ファームのバリューを送りたい。
    //             dataType: "json", //json形式で受け取る
    //             success: (function () {
    //                 let html = "";
    //                 $.each(data, function (index, value) {
    //                     let id = value.id;
    //                     let name = value.name;
    //                     let avatar = value.avatar;
    //                     let itemsCount = value.items_count;
    //                     // １ユーザー情報のビューテンプレートを作成
    //                     html = `
    //                         <tr class="user-list">
    //                             <td class="col-xs-2"><img src="${avatar}" class="rounded-circle user-avatar"></td>
    //                             <td class="col-xs-3">${name}</td>
    //                             <td class="col-xs-2">${itemsCount}</td>
    //                             <td class="col-xs-5"><a class="btn btn-info" href="/user/${id}">詳細</a></td>
    //                         </tr>
    //                             `;
    //                 });
    //                 $(".table tbody").append(html); //できあがったテンプレートをビューに追加
    //                 // 検索結果がなかったときの処理
    //                 if (data.length === 0) {
    //                     $(".user-index-wrapper").after(
    //                         '<p class="text-center mt-5 search-null">ユーザーが見つかりません</p>'
    //                     );
    //                 }
    //             }),
    //             error: function () {
    //                 //ajax通信がエラーのときの処理
    //             }

    //         });
    //     });
    });
}
