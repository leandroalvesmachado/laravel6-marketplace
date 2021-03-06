<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class HomeController extends Controller
{
    private $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        // verifica se o usuário está logado
        // $this->middleware('auth');

        $this->product = $product;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');

        $products = $this->product->limit(6)->orderBy('id', 'DESC')->get();
        $stores = \App\Store::limit(3)->orderBy('id', 'DESC')->get();

        return view('welcome', compact('products', 'stores'));
    }

    public function single($slug)
    {
        // whereSlug = where('slug', $value)
        $product = $this->product->whereSlug($slug)->first();

        return view('single', compact('product'));
    }
}
