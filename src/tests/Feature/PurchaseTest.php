<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

class PurchaseTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_purchase_product() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('product.purchase'), [
            'product_id' => $product->id,
            'payment' => 'カード払い',
            'delivery_address' => '123-4567 東京都新宿区1-2-3',
        ]);

        $purchase = Purchase::where('user_id', $user->id)->latest()->first();

        $this->assertDatabaseHas('product_purchase', [
            'purchase_id' => $purchase->id,
            'product_id' => $product->id,
        ]);
    }

    public function test_purchased_product_is_marked_as_sold_in_product_list() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('product.purchase'), [
            'product_id' => $product->id,
            'payment' => 'カード払い',
            'delivery_address' => '123-4567 東京都新宿区1-2-3',
        ]);

        $response = $this->get('/');
        $response->assertSee('SOLD');
    }

    public function test_purchased_product_is_added_to_profile_purchase_list() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $response = $this->post(route('product.purchase'), [
            'product_id' => $product->id,
            'payment' => 'カード払い',
            'delivery_address' => '123-4567 東京都新宿区1-2-3',
        ]);

        $response = $this->get('/mypage?tab=buy');
        $response->assertSee($product->name);
    }
}
