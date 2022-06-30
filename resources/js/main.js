$(function () {
    let windowHeight;
    let scroll;
    let targetPosition;

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

    // スクロールバー
    $(window).on("scroll", function () {
        windowHeight = $(window).height();
        scroll = $(window).scrollTop();

        let scrollHeight = $(document).height();
        let scrollPosition = windowHeight + scroll;
        let footHeight = $("#footer").innerHeight();

        if (scroll > 100) {
            $(".scroll-arrow").hide();
            $(".return-top").show();
        } else {
            $(".scroll-arrow").show();
            $(".return-top").hide();
        }

    });

    // セクション遷移
    $(".main-menu--list")
        .eq(0)
        .on("click", function () {
            $(window).scrollTop($("#room").position().top);
        });

    $(".main-menu--list")
        .eq(1)
        .on("click", function () {
            $(window).scrollTop($("#restaurant").position().top);
        });

    $(".main-menu--list")
        .eq(2)
        .on("click", function () {
            $(window).scrollTop($("#spa").position().top);
        });

    $(".main-menu--list")
        .eq(3)
        .on("click", function () {
            $(window).scrollTop($("#service").position().top);
        });

    $(".main-menu--list")
        .eq(4)
        .on("click", function () {
            $(window).scrollTop($("#access").position().top);
        });

    // トップに戻る
    $(".return-top").on("click", function () {
        $("body,html").animate(
            {
                scrollTop: 0,
            },
            400
        );
        return false;
    });

    // フェードイン
    $(window).on("scroll", function () {
        $(".fade").each(function () {
            windowHeight = $(window).height();
            scroll = $(window).scrollTop();
            targetPosition = $(this).offset().top;
            if (scroll >= targetPosition - windowHeight) {
                $(this).addClass("in");
            }
        });

        // ニュースフェードイン
        $(".news-parts").each(function () {
            windowHeight = $(window).height();
            scroll = $(window).scrollTop();
            targetPosition = $(this).offset().top;
            if (scroll >= targetPosition - windowHeight) {
                $(this).addClass("appear");
            }
        });

        // 時間差フェードイン
        $(".time-fade").each(function (i) {
            windowHeight = $(window).height();
            scroll = $(window).scrollTop();
            targetPosition = $(this).offset().top;
            if (scroll >= targetPosition - windowHeight) {
                $(this)
                    .delay(i * 400)
                    .queue(function () {
                        $(this).addClass("in");
                    });
            }
        });
    });

    // newsクリックでテキスト表示
    $(".news-parts").on('click', function() {
        $(this).next().toggleClass("slidedown")
    })



// 予約画面
    // 満室時に選択できないよう親要素にhiddenクラス付与
    $("td:has(p.room-full)").addClass("hidden");
    $("div.day:has(p.room-full)").addClass("hidden");

    // 予約できない日にhidden付与
    $("td:has(.no-select)").addClass("hidden");
    $("div.day:has(.no-select)").addClass("hidden");

    // option[selected]によって「ソース上の」選択状態を取得。
    let tmpSelect = $('select[name="stay"] option[selected]').val();
    // option:selected （見かけ上の選択状態）を削除。
    $('select[name="stay"] option:selected').removeAttr("selected");
    // 改めて選択を設定しなおす。
    $('select[name="stay"]').val(tmpSelect);

    $(".price").on("change", function () {
        let price = $(this).val();
        $(".input-price").val(price);
    });
});
