<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Illuminate\Routing\UrlGenerator;

class ProductController extends Controller
{
    public function productsList(Request $request){
        return response(Product::get()->toArray(), 200);
    }

    public function productNew(Request $request){
        $image = $request->image;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = str_random(10).'.'.'png';
        \File::put(public_path(). '/' . $imageName, base64_decode($image));
        $input = $request->all();
        $input['image'] = '/' . $imageName;
        Product::create($input);
        return response($request->all(), 200);
    }
}
