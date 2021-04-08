<?php

namespace App\Http\Controllers;
use App\Models\Bouquet;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $userId = Auth::user()->id;
        Cart::restore($userId);
        return view('carts.index');
    }

    public function store(Request $request)
    {
        $bouquet = Bouquet::findOrFail($request->id);
        
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($bouquet) {
            return $cartItem->id === $bouquet->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('carts.index')->with('success_message', 'Item is already in your cart!');
        }

        if ($request->quantity > $request->productQuantity) {
            return back()->with('success_message', 'We currently do not have enough items in stock.');
        }

        Cart::add($bouquet->id, $bouquet->title, $request->quantity, $bouquet->price)
            ->associate('App\Models\Bouquet');

        //Add the cart item in the database
        $id = Auth::user()->id;
        Cart::store($id);
        
        return redirect()->route('carts.index')->with('success_message', 'Item was added to your cart!');
    }

    public function update(Request $request, $id)
    {
        if ($request->operation == "add") {
            if ($request->quantity >= $request->productQuantity) {
                return back()->withErrors('We currently do not have enough items in stock.');
            }
            $this->addCart($request, $id);
        } else {
            $this->minusCart($request, $id);
        }
      
        //Store in database
        $userId = Auth::user()->id;
        Cart::store($userId);

        return back()->with('success_message','Quantity is Updated');
    }

    public function addCart(Request $request, $id) 
    {
        $bouquet = Cart::get($id);
        $bouquetqty = $bouquet->qty;
        $updateqty = $bouquetqty+1;
        Cart::update($id, $updateqty);
        return back()->with('success_message', 'update Success');
    }

    public function minusCart(Request $request, $id) 
    {
        $bouquet = Cart::get($id);
        $bouquetqty = $bouquet->qty;
        $updateqty = $bouquetqty-1;
        Cart::update($id, $updateqty);
        return back()->with('success_message', 'update Success');
    }

    public function destroy($id)
    {
        Cart::remove($id);
        //Delete the cart item in the database
        $userId = Auth::user()->id;
        Cart::store($userId);
        return back()->with('success_message', 'Item has been removed!');
    }
}
