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
        $productData = $request->get('product');

        $product = $this->product->whereSlug($productData['slug']);

        if (!$product->count() || $productData['amount'] <=  0) {
            return redirect()->route('home');
        }

        $product = array_merge($productData, $product->first(['name', 'price', 'store_id'])->toArray());

        // verificar se existe sessao para os produtos
        if (session()->has('cart')) {
            // verificando duplicidade do item
            $products = session()->get('cart');
            $productsSlugs = array_column($products, 'slug');

            if (in_array($product['slug'], $productsSlugs)) {
                $products = $this->productIncrement($product['slug'], $product['amount'], $products);
                session()->put('cart', $products);
            } else {
                // se existe, adiciona o produto na sessao existente
                // adiciona um novo valor a sessao cart
                session()->push('cart', $product);
            }
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

    public function cancel()
    {
        session()->forget('cart');

        flash('Desistência da compra realizada com sucesso!')->success();

        return redirect()->route('cart.index');
    }

    private function productIncrement($slug, $amount, $products)
    {
        $products = array_map(function($line) use ($slug, $amount) {
            if ($slug == $line['slug']) {
                $line['amount'] += $amount;
            }

            return $line;
        }, $products);

        return $products;
    }
}
