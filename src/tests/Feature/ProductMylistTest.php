<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;

class ProductMylistTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_liked_products_are_displayed_in_my_list() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->likedProducts()->attach($product);

        $this->actingAs($user);

        $response = $this->get('/?page=mylist');

        $response->assertSee($product->name);
    }

    public function test_sold_products_show_sold_label_in_my_list() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $user->likedProducts()->attach($product);

        $purchase = Purchase::factory()->create([
            'user_id' => $user->id,
            'payment' => 'コンビニ払い',
            'delivery_address' => '住所',
        ]);
        $product->purchases()->attach($purchase);

        $this->actingAs($user);

        $response = $this->get('/?page=mylist');

        $response->assertSee('SOLD');
    }

    public function test_products_posted_by_user_are_not_displayed_in_my_list() {
        $user = User::factory()->create();

        $product = Product::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('/?page=mylist');

        $response->assertDontSee($product->name);
    }

    public function test_unauthenticated_user_sees_no_products_in_my_list() {
        $response = $this->get('/?page=mylist');

        $response->assertDontSee('product name');
    }
}
