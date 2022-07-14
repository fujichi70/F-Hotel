// 日付選択時の非同期通信
$(function () {
    // カレンダー選択

    let people = 0;
    let stay = 0;
    let day = 0;

    $("select").on("change", function () {
        people = $("#people").val();
        stay = $("#stay").val();
    });

    function comma(num) {
        return String(num).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
    }

    function topUppercase(str) {
        return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
    }

    $("#reservation .day").on("click", function () {
        let isThis = $(this);
        roomGet(isThis);
    });
    
    $("[name = 'people']").on("change", function () {
        if ($("#reservation .day").hasClass("select")) {
            let isThis = $("#reservation .day.select");
            roomGet(isThis);
        }
    });
    
    $("[name = 'stay']").on("change", function () {
        if( $("#reservation .day").hasClass('select')) {
            let isThis = $("#reservation .day.select");
            roomGet(isThis);
        }
    });

    // 部屋選択後、日付選択で自動的に予約フォームにページを送る
    $("#room-detail .day").on("click", function () {
        if (!$(this).hasClass("hidden")) {
            $(".select").removeClass("select");
            $(this).addClass("select");

            day = $(this).data("day");
            people = $("#people").val();
            stay = $("#stay").val();

            $("input[name='arrival']").val(day);
            const speed = 600;
            let target = $(".reservation-main--title");
            let position = target.offset().top;
            $("body,html").animate({ scrollTop: position }, speed, "swing");
            totalGetPrice();
            return false;
        }
    });

    // 予約
    $("input[name='arrival']").on("change", function () {
        totalGetPrice();
    });

    $("#reserveStay").on("change", function () {
        totalGetPrice();
    });

    $("input[name='people']").on("change", function () {
        totalGetPrice();
    });

    // 関数
    function roomGet(isThis) {
        if (!$(isThis).hasClass("hidden")) {
            $(".select").removeClass("select");
            $(isThis).addClass("select");

            day = $(isThis).data("day");
            people = $("#people").val();
            stay = $("#stay").val();

            $(".reservation-room--box").empty();

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                url: "/reservation",
                contentType: "application/json",
                data: JSON.stringify({
                    day: day,
                    people: people,
                    stay: stay,
                }),
                dataType: "json",
            })
                .done((data) => {
                    let rooms = data.rooms;
                    let priceUp = data.priceUp;
                    $.each(rooms, function (index, room) {
                        html = `
                        <div class="reservation-room--item">
                        <button formaction="reservation/room/${
                            room.room_id
                        }" type="submit" class="reservation-room--select">
                        <h4 class="reservation-room--name" data-en="${topUppercase(
                            room.name
                        )}">${room.room_name}</h4>
                        <img src="/storage/images/${room.img_path}" alt="${
                            room.name
                        }">
                        <dl class="room-flex">
                            <dt>ベッド</dt>
                            <dd>${room.type}</dd>
                        </dl>
                        <dl class="room-flex">
                            <dt>定員人数</dt>
                            <dd>${room.people}名</dd>
                        </dl>
                        <dl class="room-flex">
                            <dt>お食事</dt>
                            <dd>朝食・夕食2食<br class="room-br">（ビュッフェ）</dd>
                            </dl>
                            <dl class="room-flex">
                            <dt>1名様の料金<br class="room-br">(税込)</dt>
                            <dd>${comma(
                                parseInt(room.price) + parseInt(priceUp)
                            )}円<br class="room-br">（${
                            room.people
                        }名様での宿泊時）</dd>
                        </dl>
                        </button>
                        <input type="hidden" name="select_day" value="${day}">
                        <input type="hidden" name="people" value="${people}">
                        <input type="hidden" name="stay" value="${stay}">
                        <button formaction="reservation/room/${
                            room.room_id
                        }" type="submit" class="btn">この部屋を選択</button>
                        </div>
                    `;
                        $(".reservation-room--box").append(html);
                    });
                })
                .fail(() => {
                    alert(
                        "エラーが発生しました。恐れ入りますが、okボタンを押し最初からやり直しをお願いいたします。"
                    );
                });
        }
    }

    function totalGetPrice() {
        let select_day = $("input[name='arrival']").val();
        stay = $("#reserveStay").val();
        people = $("input[name='people']:checked").val();

        if (select_day != "" && people != "" && stay != "") {
            $(".price-box").empty();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify({
                    select_day: select_day,
                    people: people,
                    stay: stay,
                }),
                dataType: "json",
            })
                .done((data) => {
                    let totalPrice = data.totalPrice;
                    html = `
                        <th><label class="info">合計金額</label></th>
                    	<td class="flex">
                    		<p><span class="price">${comma(
                                parseInt(totalPrice)
                            )}</span>円</p>
                    		<input type="hidden" class="input-price" name="totalprice" value="${totalPrice}">
                    	</td>

                    `;
                    $(".price-box").append(html);
                })
                .fail(() => {
                    alert(
                        "エラーが発生しました。恐れ入りますが、OKボタンを押し最初からやり直しをお願いいたします。"
                    );
                });
        }
    }
});
