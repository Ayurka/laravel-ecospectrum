<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Backend\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        return view('frontend.cart');
    }

    public function add(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->get('id');
            $quantity = $request->get('quantity');

            $product = Product::findOrFail($id);

            $cart = session()->get('cart');

            // если корзина пуста, то это первый товар
            if(!$cart) {

                $cart = [
                    $id => [
                        'title' => $product->title,
                        'quantity' => $quantity,
                        'price' => $product->price,
                        'image' => $product->image->resize(100, 150),
                    ]
                ];

                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Товар успешно добавлен в корзину!');
            }

            // if cart not empty then check if this product exist then increment quantity
            if (isset($cart[$id])) {

                $cart[$id]['quantity'] = $cart[$id]['quantity'] + $quantity;

                session()->put('cart', $cart);

                return redirect()->back()->with('success', 'Товар успешно добавлен в корзину!');

            }

            // if item not exist in cart then add to cart with quantity = 1
            $cart[$id] = [
                'title' => $product->title,
                'quantity' => $quantity,
                'price' => $product->price,
                'image' => $product->image->resize(100, 150),
            ];

            session()->put('cart', $cart);

            return redirect()->back()->with('success', 'Товар успешно добавлен в корзину!');
        }
    }

    public function update(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->get('id');
            $quantity = $request->get('quantity');

            if ($id and $quantity) {

                $cart = session()->get('cart');

                $cart[$id]["quantity"] = $quantity;

                session()->put('cart', $cart);

                session()->flash('success', 'Cart updated successfully');
            }
        }
    }

    public function remove(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->get('id');

            if ($id) {

                $cart = session()->get('cart');

                if (isset($cart[$id])) {

                    unset($cart[$id]);

                    session()->put('cart', $cart);
                }

                session()->flash('success', 'Product removed successfully');
            }
        }
    }
}
