<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class ProductDetailTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_product_detail_page_displays_all_required_info() {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category = Category::factory()->create([
            'name' => 'ファッション'
        ]);

        $product = Product::factory()->create([
            'user_id' => $user->id,
            'image' => 'https://via.placeholder.com/640x480.png',
            'condition' => '良好',
            'name' => 'Test Product',
            'brand' => 'Test Brand',
            'explanation' => 'This is a test product.',
            'price' => 10000,
        ]);

        $product->categories()->sync([$category->id]);

        $comment = Comment::factory()->create([
            'product_id' => $product->id,
            'user_id' => $user->id,
            'comment' => 'テストコメント',
        ]);

        $response = $this->get(route('product.show', $product->id));

        $response->assertSee($product->image);
        $response->assertSee($product->name);
        $response->assertSee($product->brand);
        $response->assertSeeText(number_format($product->price));
        $response->assertSeeText($product->likes()->count());
        $response->assertSeeText($product->comments()->count());
        $response->assertSee($product->explanation);
        $response->assertSee($category->name);
        $response->assertSee($product->condition);
        $response->assertSee($user->name);
        $response->assertSee($comment->comment);
    }

    public function test_product_detail_page_displays_multiple_categories()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category1 = Category::factory()->create([
            'name' => 'ファッション'
        ]);
        $category2 = Category::factory()->create([
            'name' => 'メンズ'
        ]);

        $product = Product::factory()->create([
            'user_id' => $user->id,
            'image' => 'https://via.placeholder.com/640x480.png',
            'condition' => '良好',
            'name' => 'Test Product',
            'brand' => 'Test Brand',
            'explanation' => 'This is a test product.',
            'price' => 10000,
        ]);

        $product->categories()->sync([$category1->id, $category2->id]);

        $response = $this->get(route('product.show', $product->id));

        $response->assertSee($category1->name);
        $response->assertSee($category2->name);
    }
}
