<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        // CSRF tokenni tekshirib chiqing (optional)
        if (!$request->has('X-CSRF-TOKEN') || !$request->header('X-CSRF-TOKEN')) {
            return response()->json(['error' => 'CSRF token is missing'], 403);
        }

        // Input ma'lumotlarini validatsiya qilish
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // Foydalanuvchi wishlistiga mahsulot qo'shish yoki o'chirish
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($wishlist) {
            // Mahsulotni o'chirish
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            // Yangi mahsulot qo'shish
            Wishlist::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }


}
