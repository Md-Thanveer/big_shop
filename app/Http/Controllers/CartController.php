<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Product;

use App\Models\Category;

use App\Models\Country;
use App\Models\City;

class CartController extends Controller
{
    //
    public function index(Request $request)
    {
        try 
        {
            $countries = Country::all();
            // Retrieve all cities for use in the view
            $cities = City::all();

            // Retrieve all categories for use in the view
            $categories = Category::all();

            $customer = Auth::user();

            $carts = Cart::where('customer_id', $customer->id)->get();

            $data = [
                'carts' => $carts,
                'categories' => $categories,
                'countries' => $countries,
                'cities' => $cities,
             ];

            return view('frontend.cart.index', $data);
        } catch (ModelNotFoundException $e) {
            // Handle the case where the product is not found
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
    }

    public function add_to_cart(Request $request)
    {
        $user = Auth::user();

        $customer_id = $user->id;

        $product_id = $request->input('product_id');
        $qty = $request->input('qty', 1);

        // dd($request);

        // Retrieve the product
        $product = Product::find($product_id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        // Add to cart logic here
        // Check if the item is already in the cart
        $existingCartItem = Cart::where('product_id', $product_id)
            ->where('customer_id', $customer_id)
            ->first();

        if ($existingCartItem) {
            // If the item is already in the cart, update the quantity
            $existingCartItem->qty += 1;
            $existingCartItem->save();
            
            return redirect()->back()->with('success', $product->name . "quanity updates in your cart.");
        } else {
            // If the item is not in the cart, create a new cart entry
            Cart::create([
                'product_id' => $product_id,
                'customer_id' => $user->id,
                'qty' => $qty,
            ]);
            
            return redirect()->back()->with('success', $product->name . " added to your cart." );
        }
    }

    public function increaseQuantity(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();
        $customer_id = $user->id;

        // Retrieve the cart item
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }

        // Check if the cart item belongs to the logged-in user
        if ($cartItem->customer_id != $customer_id) {
            return redirect()->route('cart.index')->with('error', 'You are not authorized to update the quantity of this item in the cart.');
        }

        // Increase the quantity
        $cartItem->qty += 1; // Use 'quantity' as per your column name
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', $cartItem->product->name .'Quantity increased in your cart.');
    }

    public function decreaseQuantity(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();
        $customer_id = $user->id;

        // Retrieve the cart item
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }

        // Check if the cart item belongs to the logged-in user
        if ($cartItem->customer_id != $customer_id) {
            return redirect()->route('cart.index')->with('error', 'You are not authorized to update the quantity of this item in the cart.');
        }

        // Decrease the quantity, but ensure it doesn't go below 1
        $cartItem->qty = max($cartItem->qty - 1, 1); // Use 'quantity' as per your column name
        $cartItem->save();

        return redirect()->route('cart.index')->with('success', $cartItem->product->name . ' Quantity decreased in your cart.');
    }

    public function removeFromCart(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();
        $customer_id = $user->id;

        // Retrieve the cart item
        $cartItem = Cart::find($id);

        // Check if the cart item exists
        if (!$cartItem) {
            return redirect()->route('cart.index')->with('error', 'Cart item not found.');
        }

        // Check if the cart item belongs to the logged-in user
        if ($cartItem->customer_id != $customer_id) {
            return redirect()->route('cart.index')->with('error', 'You are not authorized to remove this item from the cart.');
        }

        // Remove the cart item
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', $cartItem->product->name . ' Item removed from your cart.');
    }

    public function clearCart(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        $customer_id = $user->id;

        // Retrieve the cart items for the user
        $cartItems = Cart::where('customer_id', $customer_id)->get();

        // Check if any cart items were found
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'No items found in the cart.');
        }

        // Check if the cart items belong to the logged-in user
        foreach ($cartItems as $cartItem) {
            if ($cartItem->customer_id != $customer_id) {
                return redirect()->route('cart.index')->with('error', 'You are not authorized to clear the cart. Cart items do not belong to you.');
            }
        }

        // Find and delete all cart items for the user
        Cart::where('customer_id', $customer_id)->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }

    


}