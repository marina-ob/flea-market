<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Like;

class ProfileController extends Controller
{
    public function index(Request $request) {
        $tab = $request->query('tab', '');
        $user = Auth::user();
        $keyword = session('keyword', '');

        if ($tab === 'mylist') {
            if (!$user) {
                $products = collect();
            } else {
                $query = $user->likedProducts()->where('products.user_id', '!=', $user->id);
                $products = $query->get();
            }
        } else {
            $query = Product::where('user_id', "!=", optional($user)->id);

            if (!empty($keyword)) {
            $query->where('name', 'like', '%' . $keyword . '%');
            }

            $products = $query->get();
        }

        return view('index', compact('products', 'tab', 'user', 'keyword'));
    }


    public function likedProducts() {
        $user = Auth::user();
        $products = $user->likedProducts();

        return view('index', compact('products'));
    }

    public function edit() {
        $user = Auth::user();

        return view('edit' , compact('user'));
    }

    public function update(ProfileRequest $request) {
        if ($request->hasFile('image')) {
            $dir = 'images';
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/' . $dir, $file_name);
            $image = 'storage/' . $dir . '/' . $file_name;
        } else {
            $image = $request->old_image;
        }

        User::find($request->id)->update([
            'image' => $image,
            'name' => $request->name,
            'postal_code'=> $request->postal_code,
            'address' => $request->address,
            'building' => $request->building,
        ]);

        return redirect('/mypage/profile');
    }

    public function mypage(Request $request) {
        $user = Auth::user();
        $products = Product::where('user_id', auth()->id())->get();

        $userId = auth()->id();
        $purchases = Product::whereHas('purchases', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->get();

        $tab = $request->query('tab', 'default');

        return view('profile', compact('tab','user', 'products', 'purchases'));
    }
}
