<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $user->delete();
        return redirect()->route('home');
    }
}
