<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Like;

class LikeFeatureTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_like_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('product.toggleLike', ['id' => $product->id]));

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200);
        $this->assertEquals(1, $product->likes()->count());
    }

    public function test_user_can_unlike_a_product()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        Like::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $this->actingAs($user);

        $response = $this->post(route('product.toggleLike', ['id' => $product->id]));

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        ]);

        $response->assertStatus(200);
        $this->assertEquals(0, $product->likes()->count());
    }
}
