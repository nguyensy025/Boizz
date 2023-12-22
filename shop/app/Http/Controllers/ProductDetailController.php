<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class ProductDetailController extends Controller
{
    public function index(Product $product, $id, ProductImage $productImage){
        $data = $product->find($id);
        $images = $productImage->where('products.id', '=', $id);
        return view('home.product_details', compact('data', 'images'));
    }
}
