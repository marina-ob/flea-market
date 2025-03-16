<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\ExhibitionRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Category;
use App\Models\Like;
use App\Models\Comment;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class ItemController extends Controller
{
    public function listing() {
        $user = Auth::user();

        return view('listing' , compact('user'));
    }

    public function store(ExhibitionRequest $request) {
        $dir = 'images';
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/' . $dir, $file_name);
        $image = 'storage/' . $dir . '/' . $file_name;

        $product = Product::create([
            'image' => $image,
            'condition' => $request->condition,
            'name' => $request->name,
            'brand'=> $request->brand,
            'explanation' => $request->explanation,
            'price' => $request->price,
            'user_id' => Auth::user()->id,
        ]);

        if ($request->has('category')) {
            $product->categories()->sync($request->category);
        }

        return redirect('/');
    }

    public function purchase($product_id) {
        $product = Product::find($product_id);
        $user_info = Auth::user();

        return view('purchase', compact('product','user_info'));
    }

    public function address($product_id) {
        $product = Product::find($product_id);

        return view('address', compact('product'));
    }

    public function editAddress(AddressRequest $request, $product_id) {
        $product = Product::find($product_id);
        $user_info = $request->only(['postal_code', 'address', 'building']);

        return view('purchase', compact('product','user_info'));
    }

    public function createCheckoutSession(PurchaseRequest $request) {
        $product_id = $request->product_id;
        $product = Product::findOrFail($product_id);

        $purchase = Purchase::create([
            'payment' => $request->payment,
            'delivery_address' => $request->delivery_address,
            'user_id' => Auth::user()->id,
        ]);

        $purchase->products()->attach($product_id);


        Stripe::setApiKey(env('STRIPE_SECRET'));

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => [
                            'name' => $product->name,
                        ],
                        'unit_amount' => $product->price * 1,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('home'),
            'cancel_url' => route('home'),
        ]);

        return redirect($session->url);
    }

    public function getDetail($product_id)
    {
        $product = Product::find($product_id);
        $categories = $product->categories;

        foreach ($categories as $category) {
            $pivotValue = $category->pivot->name;
        }

        $product_comments = Product::with('comments.user')->findOrFail($product_id);
        $comments = $product->comments;
        $commentCount = $comments->count();

        return view('item', compact('product','category','comments','commentCount'));
    }

    public function search(Request $request) {
        $keyword = $request->keyword;
        session(['keyword' => $keyword]);

        $tab = $request->query('tab', '');

        return redirect('/' . $tab);
    }
}