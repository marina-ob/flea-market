<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\User;
use App\Models\Comment;

class CommentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_logged_in_user_can_send_comment() {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comment.store'), [
            'product_id' => $product->id,
            'comment' => 'Great product!'
        ]);

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'product_id' => $product->id,
        'comment' => 'Great product!'
        ]);

        $this->assertEquals(1, $product->comments()->count());
    }

    public function test_logged_out_user_cannot_send_comment() {
        $product = Product::factory()->create();

        $response = $this->post(route('comment.store'), [
            'product_id' => $product->id,
            'comment' => 'Great product!'
        ]);

        $response->assertRedirect(route('login'));
    }

    public function test_comment_is_required() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $response = $this->post(route('comment.store', ['product' => $product->id]), [
            'comment' => ''
        ]);

        $response->assertSessionHasErrors('comment');
    }

    public function test_comment_max_length() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();
        $longComment = str_repeat('a', 256);

        $response = $this->post(route('comment.store', ['product' => $product->id]), [
            'comment' => $longComment
        ]);

        $response->assertSessionHasErrors('comment');
    }
}
