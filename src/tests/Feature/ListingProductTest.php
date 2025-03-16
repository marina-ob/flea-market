<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ListingProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_user_can_register_product_information() {
        $user = User::factory()->create();

        $this->actingAs($user);

        $category1 = Category::factory()->create(['id' => 1]);
        $category2 = Category::factory()->create(['id' => 2]);

        Storage::fake('public');

        $image = UploadedFile::fake()->create('test_image.jpg', 100, 'image/jpeg');

        $data = [
            'name' => 'テスト商品',
            'condition' => '良好',
            'explanation' => '商品説明内容',
            'brand' => 'A',
            'price' => 1000,
            'image' => $image,
            'category' => [1,2]
        ];

        $response = $this->post('/sell',$data);

        $response->assertRedirect('/');

        $this->assertDatabaseHas('products', [
            'name' => 'テスト商品',
            'condition' => '良好',
            'explanation' => '商品説明内容',
            'brand' => 'A',
            'price' => 1000,
            'image' => 'storage/images/test_image.jpg'
        ]);

        $product = Product::where('name', 'テスト商品')->first();
        $this->assertEquals($user->id, $product->user_id);

        $this->assertTrue($product->categories->contains('id', 1));
        $this->assertTrue($product->categories->contains('id', 2));
    }
}
