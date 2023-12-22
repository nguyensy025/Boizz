<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CartController extends Controller
{
    public function index() {
        $product = DB::table('products')-> get();
        return view('home.index', compact('product'));
    }
    public function cart() {
        
        return view('home.cart');
    }
}
