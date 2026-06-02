<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        // Cek apakah user udah pernah ngasih ulasan untuk produk ini di struk ini
        $existingReview = Review::where('order_id', $request->order_id)
                                ->where('product_id', $request->product_id)
                                ->where('user_id', Auth::id())
                                ->first();

        if ($existingReview) {
            return redirect()->back()->with('error', 'Lu udah ngasih ulasan untuk produk ini.');
        }

        Review::create([
            'user_id' => Auth::id(),
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan lu berhasil disimpan.');
    }
}