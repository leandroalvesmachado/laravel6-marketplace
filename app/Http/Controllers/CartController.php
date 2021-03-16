<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Product;

class CartController extends Controller
{
    private $product;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $cart = session()->has('cart') ? session()->get('cart') : [];

        return view('cart', compact('cart'));
    }

    public function add(Request $request)
    {
        $product = $request->get('product');

        // verificar se existe sessao para os produtos
        if (session()->has('cart')) {
            // se existe, adiciona o produto na sessao existente
            // adiciona um novo valor a sessao cart
            session()->push('cart', $product);
        } else {
            // nao existe, criar esta sessao com o primeiro produto
            $products[] = $product;

            // iniciando a sessao com o produto
            session()->put('cart', $products);
        }

        flash('Produto Adicionado no carrinho!')->success();

        return redirect()->route('product.single', ['slug' => $product['slug']]);
    }

    public function remove($slug)
    {
        if (!session()->has('cart')) {
            return redirect()->route('cart.index');
        }

        $products = session()->get('cart');
        $products = array_filter($products, function($line) use ($slug) {
            return $line['slug'] != $slug;
        });

        session()->put('cart', $products);

        return redirect()->route('cart.index');
    }
}
