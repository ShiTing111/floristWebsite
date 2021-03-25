<?php

namespace App\Http\Controllers;
use App\Models\Bouquet;
use App\Models\BouquetImages;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BouquetController extends Controller
{
    // public function index() 
    // {
    //     $bouquets = Bouquet::all();
    //     return view('bouquet', ['bouquets' => $bouquets]);
    // }

    public function index()
    {
        $bouquets = Bouquet::paginate(16);
        // $images = BouquetImages::where('bouquetId', 1);
        return view('bouquet', ['bouquets' => $bouquets]);
      
    }


    public function store(Request $request) 
    {
        $bouquet = new Bouquet();

        $validated_data = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:100',
            'price' => 'required',
            'size' => 'required',
        ]);

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time().'.'.$extension;
            $file->move('storage/bouquet/', $filename);
            $bouquet->image = $filename;
        } else {
            return $request;
            $bouquet->image = '';
        }
        
        $bouquet->fill($validated_data);
        $bouquet->save();

        return redirect()->route('home')->with('alert','New Car Registered Successful!');
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('bouquet.create');
        } else {
            dd('You are not an Admin');
        }
    }
    
    public function edit()
    {
        if (Gate::allows('isAdmin')) {
            dd('Admin allowed');
        } else {
            dd('You are not an Admin');
        }
    }

    public function delete()
    {
        if (Gate::allows('isAdmin')) {
            dd('Admin allowed');
        } else {
            dd('You are not Admin');
        }
    }
}
