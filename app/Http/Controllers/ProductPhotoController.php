<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductPhoto;
use \Storage;

class ProductPhotoController extends Controller
{
    protected function unlinkPhoto($path) 
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    public function store(Request $request, $productId)
    {
        $request->validate(['photo' => 'required']);
        $file = $request->file('photo');
        $photoName = randomName($file->getClientOriginalExtension(), "_");
        Storage::disk('local')->put('public/data-product/'. $photoName, $file->get());
        ProductPhoto::create([
            'product_id' => $productId,
            'photo' => $photoName
        ]);
        return redirect()->back();
    }

    public function delete($productPhotoId)
    {
        $productPhoto = ProductPhoto::where('id', $productPhotoId)->first();
        $this->unlinkPhoto(storage_path('app/public/data-product/' . $productPhoto->photo));
        $productPhoto->delete();
        
        return redirect()->back();
    }

    public function update(Request $request, $productPhotoId)
    {
        $request->validate(['photo' => 'required']);
        $productPhoto = ProductPhoto::where('id', $productPhotoId)->first();
        $file = $request->file('photo');
        $photoName = randomName($file->getClientOriginalExtension(), "_");
        Storage::disk('local')->put('public/data-product/'. $photoName, $file->get());
        $this->unlinkPhoto(storage_path('app/public/data-product/' . $productPhoto->photo));
        $productPhoto->update(['photo' => $photoName]);
        
        return redirect()->back();
    }
}
