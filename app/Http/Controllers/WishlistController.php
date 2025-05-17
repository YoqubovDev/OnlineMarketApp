<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = Auth::id();
        $sessionId = $request->session()->getId();

        $query = Wishlist::where('product_id', $request->product_id);
        if ($userId) {
            $query->where('user_id', $userId);
        } else {
            $query->where('session_id', $sessionId);
        }

        $wishlist = $query->first();

        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id'    => $userId,
                'session_id' => $userId ? null : $sessionId,
                'product_id' => $request->product_id,
            ]);
            return response()->json(['status' => 'added']);
        }
    }

    /**
     * Optional: Call this after login to merge guest wishlist to user
     */
    public function mergeGuestWishlistToUser(Request $request)
    {
        if (!Auth::check()) return;

        $sessionId = $request->session()->getId();
        $userId = Auth::id();
        Wishlist::where('session_id', $sessionId)
            ->update(['user_id' => $userId, 'session_id' => null]);
    }


}
