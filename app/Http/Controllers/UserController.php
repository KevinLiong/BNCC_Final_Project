<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Cart;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function user()
    {
        return view('user.show', [
            'products' => Product::all()
        ]);
    }

    public function addToCart(Request $request, $id)
    {
        $user=auth()->user();
        $product=Product::findOrFail($id);

        $oldCart=Cart::where('userId', $user->id)->where('productId', $product->id)->first();

        $cart=new Cart;

        if($oldCart)
        {
            if($oldCart->quantity + $request->quantity > $product->quantity){
                return redirect()->back()->with('fail', 'The quantity requested and those in your cart exceeds the available stock.');
            }
            $oldCart->quantity = $oldCart->quantity + $request->quantity;
            $oldCart->save();
        }
        else
        {
            $cart->userId = $user->id;
            $cart->productId = $product->id;
            $cart->quantity = $request->quantity;
            $cart->save();
        }

        
        return redirect()->back()->with('success', 'Product successfully added to cart.');
    }

    public function cart()
    {
        return view('user.cart', [
            'carts' => Cart::where('userId', auth()->user()->id)->get()
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        $cart = Cart::findOrFail($id);
        $product = Product::findOrFail($cart->productId);

        $validatedData = $request->validate([
            'quantity' => 'required|numeric|min:1|max:'.$product->quantity,
        ]);

        $cart->quantity = $validatedData['quantity'];
        $cart->save();
        
        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    public function checkout(Request $request)
    {
        $user = auth()->user();
        $carts = Cart::where('userId', $user->id)->get();

        foreach($carts as $cart){
            $product = Product::findOrFail($cart->productId);
            if(($cart->quantity > $product->quantity) || ($product->quantity == 0)){
                return redirect()->back()->with('fail', 'One or more products in your cart are no longer available in the requested quantity. Please adjust the quantity or remove the product.');
            }
        }

        $validatedData = $request->validate([
            'address' => 'required|min:10|max:100',
            'postalCode' => 'required|numeric|digits:5'
        ]);


        $code = mt_rand(1000000000, 9999999999);
        
        do{
            $code = mt_rand(1000000000, 9999999999);
        }while($this->codeExist($code));
        
        $validatedData['invoiceNumber'] = $code;

        foreach($carts as $cart){
            $product = Product::find($cart->productId);
            $product->quantity -= $cart->quantity;
            $product->save();
            $cart->delete();
        }

        Invoice::create($validatedData);

        return redirect('/products')->with('success', 'Checkout successful.');
    }

    public function deleteCart($id)
    {
        $userId = auth()->user()->id;
        $cartItem = Cart::where('id', $id)->where('userId', $userId)->first();

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item successfully removed from the cart.');
    }

    public function codeExist($code)
    {
        return Invoice::where('invoiceNumber', $code)->exists();
    }
}
