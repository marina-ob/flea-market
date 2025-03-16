<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;

class LikeController extends Controller
{
    public function toggleLike($id)
    {
        $user = Auth::user();
        $product = Product::findOrFail($id);

        $like = Like::where('user_id', $user->id)->where('product_id', $product->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            Like::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
            ]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likeCount' => $product->likes()->count()
        ]);
    }
}
