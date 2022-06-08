// 日付選択時の非同期通信
$(function () {
    $(".day").on("click", function () {
        $(".reservation-room--box").empty();

        let day = $(this).val();

        if (!day) {
            return false;
        }

        function comma(num) {
            return String(num).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        }

        function topUppercase(str) {
            return str.charAt(0).toUpperCase() + str.slice(1).toLowerCase();
        }

        $.ajax({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            type: "POST",
            url: "/reservation",
            contentType: "application/json",
            data: JSON.stringify({
                day: day,
            }),
            dataType: "json",
        })
            .done((data) => {
                let select_day = data.select_day;
                let rooms = data.rooms;
                let priceUp = data.priceUp;
                let day = data.day;
                $.each(rooms, function (index, room) {
                    html = `
                    <div class="reservation-room--item">
                    	<a href="reservation/room/${room.room_id}">
                    		<h4 class="reservation-room--name" data-en="${
                                topUppercase(room.name)
                            }">${room.room_name}
                    		</h4>
                    		<img src="/storage/images/${room.img_path}" alt="${room.name}">
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
                    			<dd>${ comma(parseInt(room.price) + parseInt(priceUp)) }円<br class="room-br">（1名様での宿泊時）</dd>
                    		</dl>
                    	</a>
                    	<button onclick="location.href='reservation/room/${ room.name }'"
                    		class="btn">この部屋を選択</button>
                    </div>
                    `;
					$(".reservation-room--box").append(html);
                });
            })
            .fail(() => {
                alert("ajax Error");
            });
    });
});
