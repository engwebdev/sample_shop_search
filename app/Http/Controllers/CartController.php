<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function show()
    {
        $cart = session()->get('cart');
        $sum = 0;
        if (!$cart) {
            if ($cart == null) {
//                return redirect()->route('product.search', [$cart]);
            }
            session()->put('cart', $cart);
            session()->save();
        }
        else {
            foreach ($cart as $item) {
                $sum = $sum + ($item['Final_Price']);
            }
        }
        return view('product.opencart', [
            'cart' => $cart,
            'sum' => $sum,
        ]);
    }

    public function add(Request $request): \Illuminate\Foundation\Application|\Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $cart = session()->get('cart');
        $product = \App\Models\Product::with('variations')
            ->find($request->id);

        foreach ($product->variations as $variation) {
            $product->price = $product->price + $variation->variation_price;
        }
//        return response(['success' => $product]);//

        $cart_item = [
            'item_id' => $product->id,
            'item_name' => $product->title,
            'item_quantity' => 1,
            'item_price' => $product->price,
            'offer_price' => null,
            'Final_Price' => $product->price,
        ];
        if (!$cart) {
            $cart[$product->id] = $cart_item;
        }
        else {
            if (isset($cart[$product->id])) {
                $cart[$product->id]['item_quantity']++;
                $cart[$product->id]['Final_Price'] = $cart[$product->id]['Final_Price'] + $cart_item['item_price'];
            }
            else {
                $cart[$product->id] = $cart_item;
            }
        }
        session()->put('cart', $cart);
        session()->save();
        return response(['success' => $cart]);
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        $product = \App\Models\Product::with('variations')
            ->find($request->id);

        foreach ($product->variations as $variation) {
            $product->price = $product->price + $variation->variation_price;
        }

        $cart_item = [
            'item_id' => $product->id,
            'item_name' => $product->title,
            'item_quantity' => 1,
            'item_price' => $product->price,
            'offer_price' => null,
            'Final_Price' => $product->price,
        ];

        if (!$cart) {
            return response(['success' => 'cart not found successfully.']);
        }
        else {
            if (isset($cart[$product->id])) {
                if ($cart[$product->id]['item_quantity'] > 1) {
                    $cart[$product->id]['item_quantity']--;
                    $cart[$product->id]['Final_Price'] = $cart[$product->id]['Final_Price'] - $cart_item['item_price'];
                }
                else if ($cart[$product->id]['item_quantity'] = 1) {
                    unset($cart[$product->id]);
                }
                else {
                    return response(['success' => 'product not found in cart successfully.']);
                }
            }
        }
        session()->put('cart', $cart);
        session()->save();
        return response(['success' => $cart]);
    }

    public function clear(Request $request)
    {
        //
        $cart = session()->get('cart');
        $product = \App\Models\Product::with('variations')
            ->find($request->id);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
        }
        else {
            return response(['success' => 'product not found in cart successfully.']);
        }
        session()->put('cart', $cart);
        session()->save();
        return response(['success' => $cart]);
    }
}
