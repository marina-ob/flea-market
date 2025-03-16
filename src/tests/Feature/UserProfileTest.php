<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

class UserProfileTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_view_their_profile_information() {
        $user = User::factory()->create([
            'name' => 'テストユーザー',
            'image' => 'profile.jpg',
        ]);

        $this->actingAs($user);

        $product1 = Product::factory()->create([
            'user_id' => $user->id,
            'name' => '出品商品1',
        ]);

        $purchase = Purchase::factory()->create([
            'user_id' => $user->id,
        ]);
        $product2 = Product::factory()->create(['name' => '出品商品2']);
        $purchase->products()->attach($product2->id);

        $this->actingAs($user);

        $response = $this->get('/mypage?tab=sell');

        $response->assertStatus(200);

        $response->assertSee('テストユーザー');

        $response->assertSee('profile.jpg');

        $response->assertSee('出品商品1');

        $response = $this->get('/mypage?tab=buy');

        $response->assertSee('テストユーザー');

        $response->assertSee('profile.jpg');

        $response->assertSee('出品商品2');
    }
}
