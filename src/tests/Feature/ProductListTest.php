<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class ProductListTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_all_products_are_displayed_on_the_product_page()
    {
        $product1 = Product::factory()->create(['name' => '商品1']);
        $product2 = Product::factory()->create(['name' => '商品2']);

        $response = $this->get('/');

        $response->assertSee($product1->name);
        $response->assertSee($product2->name);
    }

    public function test_sold_products_show_sold_label()
    {
        $product = Product::factory()->create();

        $purchase = Purchase::factory()->create();
        $product->purchases()->attach($purchase);

        $response = $this->get('/');
        $response->assertSee('SOLD');
    }

    public function test_products_posted_by_user_are_not_displayed_for_the_user()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $userProduct = Product::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/');

        $response->assertDontSee($userProduct->name);
    }
}
