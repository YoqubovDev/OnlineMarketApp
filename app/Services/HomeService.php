<?php

namespace App\Services;

use App\Models\Banner;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Discount;
use App\Models\Newsletter;
use App\Models\Post;
use App\Models\Product;
use App\Models\Team;

class HomeService
{
    public function getHomeData()
    {
        $parentCategories = Category::query()
            ->whereNull('parent_id')
            ->orderBy('id', 'desc')
            ->limit(4)
            ->with('categories')
            ->get();

        $cartItems = CartItem::query()
            ->with('product')
            ->orderBy('id', 'desc')
            ->get();

        $cartProductIds = $cartItems->pluck('product_id');
        $cartProducts = Product::whereIn('id', $cartProductIds)->get();

        $discount = Discount::query()->orderBy('id', 'desc')->first();

        return [
            'topBanners' => Banner::query()
                ->where('position', 'top')
                ->get(),

            'midBanner' => Banner::query()
                ->where('position', 'middle')
                ->latest('updated_at')
                ->first(),

            'bottomBanner' => Banner::query()
                ->where('position', 'bottom')
                ->latest('updated_at')
                ->first(),

            'oneBottomBanners' => Banner::query()
                ->where('position', 'one_bottom')
                ->latest('updated_at')
                ->limit(2)
                ->get(),

            'categories' => Category::query()
                ->orderBy('id', 'desc')
                ->with(['images', 'parent'])
                ->get(),

            'category_cart' => Category::query()
                ->orderBy('id', 'desc')
                ->with(['images', 'parent'])
                ->first(),

            'latestPosts' => Post::query()
                ->orderBy('id', 'desc')
                ->with('postCategory')
                ->limit(10)
                ->get(),

            'insPosts' => Post::query()
                ->orderBy('id', 'desc')
                ->with('insPostCategory')
                ->limit(10)
                ->get(),

            'parentCategories' => $parentCategories,

            'productsMenu' => $parentCategories,

            'newsletter' => Newsletter::query()
                ->orderBy('id', 'desc')
                ->first(),

            'products' => Product::query()
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get(),

            'newArrivalProducts' => Product::whereHas('category', function ($query) use ($parentCategories) {
                $query->whereIn('id', $parentCategories->pluck('id'));
            })->orderBy('id', 'desc')->limit(4)->get(),

            'discount_price' => $discount?->discount_price,
            'discount_name' => $discount?->name,
            'discount_start_date' => $discount?->start_date,
            'discount_end_date' => $discount?->end_date,

            'cart_items' => $cartItems,
            'cart_products' => $cartProducts,

            'groupTeam' => Team::query()
                ->orderBy('id', 'desc')
                ->limit(10)
                ->get(),
        ];
    }
}
