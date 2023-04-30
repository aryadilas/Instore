<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPhoto;
use \Storage;

class ProductController extends Controller
{
    // protected function unlinkPhoto($path) 
    // {
    //     if (file_exists($path)) {
    //         unlink($path);
    //     }
    // }

    public function index()
    {
        $product = Product::withTrashed()->get();
        return view('admin\pages\product', ['data' => $product]);
    }

    public function add()
    {
        return view('admin\pages\productAdd');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'productName' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required',
            'mainPhoto' => 'required'
        ]);

        $file = $request->file('mainPhoto');
        $time = time();
        $mainPhotoName = $time . '.' . $file->getClientOriginalExtension();
        Storage::disk('local')->put('public/data-product/'. $mainPhotoName, $file->get());

        $product = Product::create([
            'productName' => $request->productName,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category' => $request->category,
            'photo' => $mainPhotoName,
        ]);
   
        foreach ($request->photo as $i => $photo) {
            $file = $request->file('photo.' . $i);
            $photoName = $time . '_' . $i . '.' . $file->getClientOriginalExtension();
            Storage::disk('local')->put('public/data-product/'. $photoName, $file->get());

            ProductPhoto::create([
                'product_id' => $product->id,
                'photo' => $photoName
            ]);
        }

        return redirect('/product');

    }

    public function edit($productId)
    {
        $product = Product::where('id', $productId)->first();
        return view('admin\pages\productEdit', ['data' => $product]);
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'productName' => 'required',
            'price' => 'required',
            'description' => 'required',
            'category' => 'required',
            'stock' => 'required',
        ]);

        $product = Product::where('id', $productId)->first();
        // dd($product->productPhoto[1]->photo);
        $mainPhotoName = $product->photo;
        if($request->hasFile('mainPhoto')){
            $file = $request->file('mainPhoto');
            $mainPhotoName = randomName($file->getClientOriginalExtension(), "_");
            Storage::disk('local')->put('public/data-product/'. $mainPhotoName, $file->get());
            unlinkPhoto(storage_path('app/public/data-product/' . $product->photo));
        }
        
        $product->update([
            'productName' => $request->productName,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'category' => $request->category,
            'photo' => $mainPhotoName
        ]);


        // foreach ($request->photo as $i => $photo) {
        //     $file = $request->file('photo.' . $i);
        //     $photoName = randomName($file->getClientOriginalExtension(), "_");
            
        //     Storage::disk('local')->put('public/data-product/'. $photoName, $file->get());
            
        //     ProductPhoto::create([
        //         'product_id' => $product->id,
        //         'photo' => $photoName
        //     ]);
            
        //     if ($product->productPhoto()->count() > $i) {
                
        //         $productPhoto = $product->productPhoto[$i];

        //         $this->unlinkPhoto(storage_path('app/public/data-product/' . $productPhoto->photo));
                
        //         ProductPhoto::where('id', $productPhoto->id)->delete();

        //     }
        // }

        // if($request->hasFile('mainPhoto')){

        // }

        return redirect()->back();

    }

    

    // public function deleteMainPhoto($productId)
    // {
    //     $product = Product::where('id', $productId)->first();
    //     $photoPath = storage_path('app/public/data-product/' . $product->photo);
        
    //     $product->update(['photo' => null]);

    //     $this->unlinkPhoto($photoPath);

    //     return redirect()->back();
    // }

    public function delete($productId)
    {
        Product::where('id', $productId)->delete();
        return redirect('/product');
    }

    public function restore($productId)
    {
        Product::where('id', $productId)->restore();
        return redirect('/product');
    }
}
