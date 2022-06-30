<?php

namespace Database\Seeders;

use App\Models\Reservation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::create([
            'reservation_id' => '#123456',
            'room_id' => '1',
            'lastname' => '山田',
            'firstname' => '太郎',
            'email' => 'test1@test.com',
            'address' => '北海道札幌市中央区',
            'tel' => '0111234567',
            'people' => '1',
            'men' => '1',
            'women' => '0',
            'arrival' => '2023-01-22',
            'departure' => '2023-01-23',
            'checkin_time' => '15:00',
            'totalprice' => '18000',
        ]);

        Reservation::create([
            'reservation_id' => '#789012',
            'room_id' => '2',
            'lastname' => '佐藤',
            'firstname' => '加奈子',
            'email' => 'test2@test.com',
            'address' => '北海道札幌市西区',
            'tel' => '0111234568',
            'people' => '2',
            'men' => '0',
            'women' => '2',
            'arrival' => '2022-12-19',
            'departure' => '2022-12-21',
            'checkin_time' => '14:00',
            'totalprice' => '68000',
        ]);

        Reservation::create([
            'reservation_id' => '#345678',
            'room_id' => '6',
            'lastname' => '神宮寺',
            'firstname' => '清彦',
            'email' => 'test3@test.com',
            'address' => '北海道札幌市中央区',
            'tel' => '0111234561',
            'people' => '2',
            'men' => '1',
            'women' => '1',
            'arrival' => '2022-05-22',
            'departure' => '2022-05-23',
            'checkin_time' => '15:00',
            'totalprice' => '60000',
        ]);

        Reservation::create([
            'reservation_id' => '#901234',
            'room_id' => '1',
            'lastname' => '佐藤',
            'firstname' => '太郎',
            'email' => 'test4@test.com',
            'address' => '北海道札幌市白石区',
            'tel' => '0111234562',
            'people' => '1',
            'men' => '1',
            'women' => '0',
            'arrival' => '2022-10-05',
            'departure' => '2022-10-08',
            'checkin_time' => '20:00',
            'totalprice' => '54000',
        ]);

        Reservation::create([
            'reservation_id' => '#567890',
            'room_id' => '5',
            'lastname' => '田中',
            'firstname' => '秀美',
            'email' => 'test5@test.com',
            'address' => '北海道札幌市清田区',
            'tel' => '0111234563',
            'people' => '2',
            'men' => '1',
            'women' => '1',
            'arrival' => '2023-02-22',
            'departure' => '2023-02-23',
            'checkin_time' => '17:00',
            'totalprice' => '46000',
        ]);

        Reservation::create([
            'reservation_id' => '#111111',
            'room_id' => '1',
            'lastname' => '菊池',
            'firstname' => '次郎',
            'email' => 'test6@test.com',
            'address' => '北海道札幌市東区',
            'tel' => '0111234564',
            'people' => '1',
            'men' => '1',
            'women' => '0',
            'arrival' => '2023-01-22',
            'departure' => '2023-01-23',
            'checkin_time' => '15:00',
            'totalprice' => '18000',
        ]);

        Reservation::create([
            'reservation_id' => '#222222',
            'room_id' => '4',
            'lastname' => '高橋',
            'firstname' => '雄介',
            'email' => 'test7@test.com',
            'address' => '北海道札幌市厚別区',
            'tel' => '0111234564',
            'people' => '1',
            'men' => '1',
            'women' => '0',
            'arrival' => '2022-11-02',
            'departure' => '2022-11-05',
            'checkin_time' => '19:00',
            'totalprice' => '120000',
        ]);

        Reservation::create([
            'reservation_id' => '#333333',
            'room_id' => '5',
            'lastname' => '後藤',
            'firstname' => '歩',
            'email' => 'test8@test.com',
            'address' => '北海道札幌市北区',
            'tel' => '0111234565',
            'people' => '2',
            'men' => '1',
            'women' => '1',
            'arrival' => '2022-10-31',
            'departure' => '2022-11-01',
            'checkin_time' => '16:00',
            'totalprice' => '46000',
        ]);

    }
}
