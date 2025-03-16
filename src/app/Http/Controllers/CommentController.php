<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Comment;

class CommentController extends Controller
{
    public function comment(CommentRequest $request) {
        $comment = Comment::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'comment' => $request->comment
        ]);

        return redirect()->route('product.show', ['product_id' => $request->product_id]);
    }
}
