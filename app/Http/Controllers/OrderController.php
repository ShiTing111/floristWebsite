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
        
        $orders = Auth::user()->orders()->with('bouquets')->orderby('id','desc')->get(); // fix n + 1 issues

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

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        return view('orders.edit', ['order' => $order]);
    }
}
