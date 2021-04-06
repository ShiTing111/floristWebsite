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
      
        $top_pick = DB::table('bouquets')->orderBy('id','DESC')->paginate(4);
        $top_pick2 = DB::table('bouquets')->orderBy('id','ASC')->paginate(4);
        
        $userId = Auth::user()->id;
        Cart::restore($userId);
        return view('carts.index');
        // return view('carts.index')->with([
        //     'top_pick' => $top_pick,
        //     'top_pick2' => $top_pick2,
        
        // ]);
    }

    public function store(Request $request)
    {
        $bouquet = Bouquet::findOrFail($request->id);
        
        $duplicates = Cart::search(function ($cartItem, $rowId) use ($bouquet) {
            return $cartItem->id === $bouquet->id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('carts.index');
        }

        Cart::add($bouquet->id, $bouquet->title, $request->quantity, $bouquet->price)
            ->associate('App\Models\Bouquet');

        //Add the cart item in the database
        $id = Auth::user()->id;
        Cart::store($id);
        
        return redirect()->route('carts.index');
        //return redirect()->route('bouquets.show')->with('success_message', 'Item was added to your cart!');
    }

     /**
     * Update the specified resource in storage.
     **/
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'quantity' => 'required|numeric|between:1,5'
        ]);

        if ($validator->fails()) {
            session()->flash('errors', collect(['Quantity must be between 1 and 5.']));
            return response()->json(['success' => false], 400);
        }

        if ($request->quantity > $request->quantity) {
            session()->flash('errors', collect(['We currently do not have enough items in stock.']));
            return response()->json(['success' => false], 400);
        }

        Cart::update($id, $request->quantity);
        
        //Store in database
        $userId = Auth::user()->id;
        Cart::store($userId);

        session()->flash('success_message', 'Quantity was updated successfully!');
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Cart::remove($id);
        //Delete the cart item in the database
        $userId = Auth::user()->id;
        Cart::store($userId);
        return back()->with('success_message', 'Item has been removed!');
    }
    
    public function switchToSaveForLater($id)
    {
        $item = Cart::get($id);

        Cart::remove($id);

        $duplicates = Cart::instance('saveForLater')->search(function ($cartItem, $rowId) use ($id) {
            return $rowId === $id;
        });

        if ($duplicates->isNotEmpty()) {
            return redirect()->route('carts.index')->with('success_message', 'Item is already Saved For Later!');
        }

        Cart::instance('saveForLater')->add($item->id, $item->name, 1, $item->price)
            ->associate('App\Models\Bouquet');

        return redirect()->route('carts.index')->with('success_message', 'Item has been Saved For Later!');
    }
}
