<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::factory()->create();

        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Armani+Mens+Clock.jpg',
            'condition' => '良好',
            'name' => '腕時計',
            'brand' => 'A社',
            'explanation' => 'スタイリッシュなデザインのメンズ腕時計',
            'price' => '15000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/HDD+Hard+Disk.jpg',
            'condition' => '目立った傷や汚れなし',
            'name' => 'HDD',
            'brand' => 'B社',
            'explanation' => '高速で信頼性の高いハードディスク',
            'price' => '5000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/iLoveIMG+d.jpg',
            'condition' => 'やや傷や汚れあり',
            'name' => '玉ねぎ3束',
            'brand' => 'C社',
            'explanation' => '新鮮な玉ねぎ3束のセット',
            'price' => '300',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Leather+Shoes+Product+Photo.jpg',
            'condition' => '状態が悪い',
            'name' => '革靴',
            'brand' => 'D社',
            'explanation' => 'クラシックなデザインの革靴',
            'price' => '4000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Living+Room+Laptop.jpg',
            'condition' => '良好',
            'name' => 'ノートPC',
            'brand' => 'E社',
            'explanation' => '高性能なノートパソコン',
            'price' => '45000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Music+Mic+4632231.jpg',
            'condition' => '目立った傷や汚れなし',
            'name' => 'マイク',
            'brand' => 'F社',
            'explanation' => '高音質のレコーディング用マイク',
            'price' => '8000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Purse+fashion+pocket.jpg',
            'condition' => 'やや傷や汚れあり',
            'name' => 'ショルダーバッグ',
            'brand' => 'G社',
            'explanation' => 'おしゃれなショルダーバッグ',
            'price' => '3500',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Tumbler+souvenir.jpg',
            'condition' => '状態が悪い',
            'name' => 'タンブラー',
            'brand' => 'H社',
            'explanation' => '使いやすいタンブラー',
            'price' => '500',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/Waitress+with+Coffee+Grinder.jpg',
            'condition' => '良好',
            'name' => 'コーヒーミル',
            'brand' => 'I社',
            'explanation' => '手動のコーヒーミル',
            'price' => '4000',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
        $param = [
            'image' => 'https://coachtech-matter.s3.ap-northeast-1.amazonaws.com/image/%E5%A4%96%E5%87%BA%E3%83%A1%E3%82%A4%E3%82%AF%E3%82%A2%E3%83%83%E3%83%95%E3%82%9A%E3%82%BB%E3%83%83%E3%83%88.jpg',
            'condition' => '目立った傷や汚れなし',
            'name' => 'メイクセット',
            'brand' => 'J社',
            'explanation' => '便利なメイクアップセット',
            'price' => '2500',
            'user_id' => $user->id
        ];
        DB::table('products')->insert($param);
    }
}
