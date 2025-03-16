<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserUpdateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_see_initial_values_on_profile_page() {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'image' => 'profile.jpg',
            'postal_code' => '123-4567',
            'address' => '東京都渋谷区1-1-1',
            'building' => 'テストマンション101'
        ]);

        $this->actingAs($user);

        $response = $this->get('/mypage/profile');

        $response->assertStatus(200);

        $response->assertSee('テストユーザー');

        $response->assertSee('profile.jpg');


        $response->assertSee('123-4567');

        $response->assertSee('東京都渋谷区1-1-1');

        $response->assertSee('テストマンション101');
    }
}
