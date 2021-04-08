<?php

namespace App\Http\Controllers;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\BouquetOrder;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Gate;
use Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        if (Gate::allows('isUser')) {
            if (Cart::instance('default')->count() == 0) {
                return redirect()->route('shop.index');
            }

            if (auth()->user() && request()->is('guestCheckout')) {
                return redirect()->route('checkouts.index');
            }
        
            return view('checkouts.index')->with([
                'total' => Cart::instance('default')->total(),
            ]);
        } else {
            return view('unauthorized');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('isUser')) {
            //Check current item stock when there are less items available to purchase
            if ($this->productsAreNoLongerAvailable()) {
                return back()->withErrors('Sorry! One of the items in your cart is no longer avialble.');
            }

            $order = $this->addToOrdersTables($request); 
            
            //Decrease the quantities of all the bouquets in the cart
            $this->decreaseQuantities();

            Cart::instance('default')->destroy();     
            
            //Delete the cart item in the database
            $userId = Auth::user()->id;
            Cart::instance('default')->store($userId);
        
            if (Cart::instance('default')->count() == 0) {
                return redirect()->route('confirmations.index')->with('success_message', 'Thank you! Your payment has been successfully accepted!');
            }
        } else {
            return view('unauthorized');
        }
    }

    protected function addToOrdersTables($request)
    {
        $order = new Order();

        $validated_data = $request->validate([
            'billing_email' => 'required|max:255',
            'billing_name' => 'required|string|max:255',
            'billing_address' => 'required|string|max:255',
            'billing_city' => 'required|string|max:255',
            'billing_phone' => 'required|min:10|max:13|numeric',
            'billing_province' => 'required|string|max:255',
            'billing_postalcode' => 'required|numeric',
            'billing_phone' => 'required|numeric',
        ]);

        $order->user_id = Auth::user() ? Auth::user()->id : null;
        $order->billing_total = Cart::total();
        $order->fill($validated_data);
        $order->save();

        // Insert into order_bouquet table
        foreach (Cart::content() as $item) {
            BouquetOrder::create([
                'order_id' => $order->id,
                'bouquet_id' => $item->model->id,
                'quantity' => $item->qty,
            ]);
        }

        return $order;
    }

    protected function decreaseQuantities()
    {
        foreach (Cart::content() as $item) {
            $bouquet = Bouquet::find($item->model->id);

            $bouquet->update(['quantity' => $bouquet->quantity - $item->qty]);
        }
    }

    protected function productsAreNoLongerAvailable()
    {
        foreach (Cart::content() as $item) {
            $bouquet = Bouquet::find($item->model->id);
            if ($bouquet->quantity < $item->qty) {
                return true;
            }
        }

        return false;
    }
}
