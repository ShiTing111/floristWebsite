<?php

namespace App\Http\Controllers;
use App\Models\BouquetOrder;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $orders = Order::with('bouquets')->orderby('id','desc')->get();
        } else {
            $orders = Auth::user()->orders()->with('bouquets')->orderby('id','desc')->get(); 
        }
        return view('orders.index', ['orders' => $orders]);
    }

    public function show(Order $order)
    {
        $bouquets = $order->bouquets;

        return view('orders.show')->with([
            'order' => $order,
            'bouquets' => $bouquets,
        ]);
    }

    public function edit(Order $order)
    {
        $count = 0;
        foreach ($order->bouquets as $bouquet){
            $count += $bouquet->pivot->quantity;
        }
        $bouquets = $order->bouquets;
        
        return view('orders.edit')->with([
            'order' => $order,
            'bouquets' => $bouquets,
            'count' => $count,
        ]);
    }

    public function update(Request $request, $id)
    {   
        $order = Order::findOrFail($id);
        $order->fill($request->all());
        $order->save();

        return back()->with('success_message', 'Update Success');
    }

    public function destroy(Order $order)
    {
        //If user cancel order, bouquet quantity will be increased.
        foreach ($order->bouquets as $bouquet){
            $bouquet->update(['quantity' => $bouquet->quantity + $bouquet->pivot->quantity]);
        }

        //Delete the bouquet order records according to the order id
        BouquetOrder::where('order_id', $order->id)->delete();
        $order->delete();
        return redirect()->route('orders.index');
    }
}
