<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    public function toggle(Request $request)
    {
        $productId = $request->product_id;
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['status' => 'unauthenticated'], 401);
        }
        $wishlist = Wishlist::where('user_id', $userId)->where('product_id', $productId)->first();
        if ($wishlist) {
            $wishlist->delete();
            return response()->json(['status' => 'removed']);
        } else {
            Wishlist::create([
                'user_id' => $userId,
                'product_id' => $productId,
            ]);
            return response()->json(['status' => 'added']);
        }
    }
}
