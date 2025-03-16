<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductSearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_product_name_partial_search_excludes_user_products()   {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $product = Product::factory()->create(['user_id' => $otherUser->id, 'name' => 'Test Product']);
        $userProduct = Product::factory()->create(['user_id' => $user->id, 'name' => 'User Product']);

        $this->actingAs($user);

        $response = $this->get('/?keyword=Test');

        $response->assertSee($product->name);
        $response->assertDontSee($userProduct->name);
    }


    public function test_search_keyword_is_retained_in_mylist_page() {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $product = Product::factory()->create(['user_id' => $otherUser->id, 'name' => 'Test Product']);

        $this->actingAs($user);

        $response = $this->get('/?keyword=Test');

        $response->assertSee($product->name);

        $response = $this->get('/?page=mylist');

        $response = $this->get('/');

        $response->assertSee($product->name);
    }
}
