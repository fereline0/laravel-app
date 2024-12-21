<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->with('book')->paginate(20);

        return view('cart.index', compact('purchases'));
    }

    public function addToCart(Request $request, $bookId)
    {
        $user = Auth::user();
        $book = Book::findOrFail($bookId);

        $purchase = Purchase::where('user_id', $user->id)
            ->where('book_id', $book->id)
            ->first();

        if ($purchase) {
            $purchase->quantity++;
            $purchase->save();
        } else {
            Purchase::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('status', 'purchase-created');
    }

    public function removeFromCart($bookId)
    {
        $user = Auth::user();

        $purchase = Purchase::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->first();

        if ($purchase) {
            if ($purchase->quantity > 1) {
                $purchase->quantity--;
                $purchase->save();
            } else {
                $purchase->delete();
            }
        }

        return redirect()->back()->with('success', 'purchase-deleted');
    }
}
