<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

class DeliveryAddressTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_update_delivery_address_and_see_it_in_purchase() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $user_info = [
            'postal_code' => '123-4567',
            'address' => '東京都新宿区テスト1-1-1',
            'building' => 'テストマンション101',
        ];

        $response = $this->post(route('edit.address', ['product_id' => $product->id]), $user_info);

        $response->assertStatus(200)
                ->assertViewIs('purchase')
                ->assertViewHas('product', $product)
                ->assertSee('123-4567')
                ->assertSee('東京都新宿区テスト1-1-1')
                ->assertSee('テストマンション101');
    }

    public function test_purchased_product_has_correct_delivery_address() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $user_info = [
            'postal_code' => '123-4567',
            'address' => '東京都新宿区テスト1-1-1',
            'building' => 'テストマンション101',
        ];

        $response = $this->post(route('edit.address', ['product_id' => $product->id]), $user_info);

        $delivery_address = trim(implode(' ', array_filter($user_info)));

        $response = $this->post(route('product.purchase'), [
            'product_id' => $product->id,
            'payment' => 'カード払い',
            'delivery_address' => $delivery_address
        ]);

        $this->assertDatabaseHas('purchases', [
            'payment' => 'カード払い',
            'delivery_address' => '123-4567 東京都新宿区テスト1-1-1 テストマンション101'
        ]);
    }
}
