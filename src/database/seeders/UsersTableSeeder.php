<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => 'テスト太郎',
            'email' => 'test@example.com',
            'email_verified_at' => null,
            'password' => bcrypt('test1234'),
            'remember_token' => Str::random(10),
            'image' => 'profile.jpg',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストマンション101'
        ];
        DB::table('users')->insert($param);
    }
}
