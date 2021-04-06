<?php

namespace App\Http\Controllers;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;

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
        return view('bouquets.index', ['bouquets' => $bouquets]);
      
    }

    public function show($id)
    {
        $user = Auth::user();
        $bouquet = Bouquet::findOrFail($id);

        return view('bouquets.show',[
            'bouquet' => $bouquet,
        ]);
    }

    public function store(Request $request) 
    {
        $bouquet = new Bouquet();

        $validated_data = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:300',
            'price' => 'required',
            'category' => 'required',
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

        return redirect()->route('bouquets.index')->with('alert','New Bouquet Registered Successful!');
    }

    public function create()
    {
        if (Gate::allows('isAdmin')) {
            return view('bouquets.create');
        } else {
            dd('You are not an Admin');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        if (Gate::allows('isAdmin')) {
            $bouquet = Bouquet::findOrFail($id);
            return view('bouquets.edit', ['bouquet' => $bouquet]);
        } else {
            dd('You are not an Admin');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $bouquet = Bouquet::findOrFail($id);

        $validated_data = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:300',
            'price' => 'required',
            'category' => 'required',
        ]);

        if($request->hasfile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension(); //getting image extension
            $filename = time().'.'.$extension;
            $file->move('storage/bouquet/', $filename);
            $bouquet->image = $filename;
        }

        $bouquet->fill($validated_data);
        $bouquet->save() ;

        return redirect()->route('bouquets.index')->with('alert','Bouquet Updated Successful!');
    }

    public function destroy($id)
    {
        if (Gate::allows('isAdmin')) {
            $bouquet = Bouquet::find($id);
            $bouquet->delete();
            return redirect()->route('bouquets.index');
        } else {
            dd('You are not Admin');
        }
    }
}
