<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Find or create cart for user or session
        $cart = Cart::firstOrCreate(
            Auth::check()
                ? ['user_id' => Auth::id()]
                : ['session_id' => Session::getId()],
            []
        );

        // Find or create cart item
        $cartItem = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $quantity;
            $cartItem->save();
        } else {
            $cartItem = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }

        // Get updated cart count and total
        $cartItems = $cart->items()->with('product')->get();
        $count = $cartItems->sum('quantity');
        $total = $cartItems->sum(function ($item) {
            return $item->product->sale_price * $item->quantity;
        });

        return response()->json([
            'status' => 'success',
            'count' => $count,
            'total' => number_format($total, 2),
        ]);
    }
}
