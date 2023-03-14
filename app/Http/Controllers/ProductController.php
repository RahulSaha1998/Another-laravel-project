<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Product;
use App\models\User;
use Illuminate\Support\Facades\File;
use Session;

class ProductController extends Controller
{
    function index(){
        $products = Product::paginate(5);
        return view('products.index', compact('products'));
    }

    

    function create(){
        return view('products.create');
    }

    function store(Request $request){
        $this->validate($request,
        [
            'name'=> 'required|',
            'description'=>'required|',
            'price'=>'required|',
            'image'=>'required|',
          
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        if($request->hasfile('image'))
        {
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        }
        
        $product->save();
        return redirect()->back()->with('status', 'Product added successfully!');

    }



// ---------------------------Edit---------------------------------


    function edit($id){
        $product = Product::find($id);
        return view('products.edit', compact('product'));
    }



   


// ---------------------------Update---------------------------------

    function update(Request $request, $id){
        $product = Product::find($id);

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');

        if($request->hasfile('image'))
        {
            $destination = 'uploads/product/'.$product->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $file = $request->file('image');
            $extenstion = $file->getClientOriginalExtension();
            $filename = time().'.'.$extenstion;
            $file->move('uploads/product/', $filename);
            $product->image = $filename;
        }
        
        $product->update();
        return redirect()->back()->with('status', 'Product updated successfully!');
    }



// ---------------------------Delete---------------------------------
    function destroy($id){
        $product = Product::find($id);
        $destination = 'uploads/product/'.$product->image;
            if(File::exists($destination))
            {
                File::delete($destination);
            }
            $product->delete();
            return redirect()->back()->with('status', 'Product deleted successfully!');
    }




    // ---------------------------For Searching---------------------------------
    function search(Request $request){
        $search_text = $request->get('query');
        $products = Product::where('description','Like', '%'.$search_text.'%')->get();
        return view('products.search', compact('products'));
      }

}
