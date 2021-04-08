<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth;

class UserController extends Controller
{
    function index()
    {
        $user = Auth::user();
        return view('users.index', ['user' => $user]);
    }

    function update(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
      
        return back()->with('success_message','Profile Updated');
    }

    function destroy($id)
    {
        $user = Auth::user();

        $orders = Order::with('user')->get();
        $pendingOrder = 0;

        //check whether the user is ordering bouquets
        foreach ($orders as $order) {
            if($order->user->id == $id && $order->delivery_status =="Pending") {
                $pendingOrder += 1;
            }
        }
    
        if($pendingOrder > 0){
            return back()->withErrors('Sorry! You are ordering the bouquet(s). Cannot delete account.');
        }else{
            $user->delete();
            return redirect()->route('home');
        }
    }
}
