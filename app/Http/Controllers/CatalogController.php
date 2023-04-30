<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index()
    {
        $data = Product::where('deleted_at', null)->paginate(20);
        return view('pages/catalog', ['data' => $data]);
    }

    public function show($id)
    {
        $data = Product::where('id',$id)->where('deleted_at', null)->first();
        return view('pages/catalogDetail', ['data' => $data]);
    }
}
