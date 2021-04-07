<?php

namespace App\Http\Controllers;
use App\Models\Bouquet;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Auth;
use App\Models\Category;

class BouquetController extends Controller
{
    public function index()
    {
        $pagination = 8;
        $categories = Category::all();

        //sort by category
        if (request()->category) {
            $category_id = request()->category;
            $bouquets = Bouquet::whereHas('category', function ($query) use ($category_id) {
                $query->where('id', $category_id);
            })->get();
        } else {
            $bouquets = Bouquet::where('category_id', '>', 0)->get();
        }
        
        if (request()->sort == 'low_high') {
            $bouquets = $bouquets->sortBy('price');
        } else if (request()->sort == 'high_low') {
            $bouquets = $bouquets->sortByDesc('price');
        } else if (request()->sort == 'Newest') {
            $bouquets = $bouquets->sortByDesc('id');
        }

        return view('bouquets.index', ['bouquets' => $bouquets, 
        'categories' => $categories]);
    }

    public function show($id)
    {
        $user = Auth::user();
        $bouquet = Bouquet::findOrFail($id);
        $stockLevel = $this->getStockLevel($bouquet->quantity);

        return view('bouquets.show',[
            'bouquet' => $bouquet,
            'stockLevel' => $stockLevel,
        ]);
    }

    public function store(Request $request) 
    {
        $bouquet = new Bouquet();

        $validated_data = $request->validate([
            'title' => 'required|max:20',
            'description' => 'required|max:300',
            'price' => 'required',
            'quantity' => 'required',
            'category_id' => 'required',
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
            $categories = Category::all();
            return view('bouquets.create', [
                'categories' => $categories,
            ]);
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
            $categories = Category::all();
            return view('bouquets.edit', ['bouquet' => $bouquet, 
            'categories' => $categories]);
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
            'category_id' => 'required',
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

    function getStockLevel($quantity)
    {
        if ($quantity >  5) {
            $stockLevel = '<div class="badge badge-success">In Stock</div>';
        } elseif ($quantity <= 5 && $quantity > 0) {
            $stockLevel = '<div class="badge badge-warning">Low Stock</div>';
        } else {
            $stockLevel = '<div class="badge badge-danger">Not available</div>';
        }

        return $stockLevel;
    }   
}
