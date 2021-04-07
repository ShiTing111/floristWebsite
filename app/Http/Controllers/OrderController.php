<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

class OrderController extends Controller
{
    public function index()
    {
        // $orders = Order::paginate(10);
        // return view('orders.index', ['orders' => $orders]);
        
        // $orders = Auth::user()->orders()->with('bouquets')->orderby('id','desc')->get(); // fix n + 1 issues
        $orders = Order::with('bouquets')->orderby('id','desc')->get();

        return view('orders.index')->with('orders', $orders);
      
    }

    public function show(Order $order)
    {
        if (Auth::id() !== $order->user_id) {
            return back()->withErrors('You do not have access to this!');
        }

        $bouquets = $order->bouquets;

        return view('orders.show')->with([
            'order' => $order,
            'bouquets' => $bouquets,
        ]);
    }

    public function edit(Order $order)
    {
        // $order = Order::findOrFail($id);
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

        return back()->with('success_message', 'update Success');
    }

    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
        return redirect()->route('orders.index');
    }
}
