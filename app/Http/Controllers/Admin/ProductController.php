<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Product;

use App\Http\Requests\ProductRequest;

use App\Traits\UploadTrait;

class ProductController extends Controller
{
    use UploadTrait;
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $products = $this->product->paginate(10);

        // retornando somente os produtos do usuário logado
        $user = auth()->user();

        if (!$user->store()->exists()) {
            flash('É necessário criar uma loja para cadastrar os produtos')->warning();
            return redirect()->route('admin.stores.index');
        }
        
        $products = $user->store->products()->paginate(10);

        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $stores = \App\Store::all(['id', 'name']);
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();

        // pasando um valor padrão null, caso não venha nenhuma categoria no request
        $categories = $request->get('categories', null);

        $data['price'] = formatPriceToDatabase($data['price']);

        // $store = \App\Store::find($data['store']);
        // recuperando loja do usuario pelo auth
        $store = auth()->user()->store;
        $product = $store->products()->create($data);
        $product->categories()->sync($categories);

        // verifica se no request existe um upload a ser feito
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');

            // vinculando imagens ao produto
            // createMany = salva um array
            $product->photos()->createMany($images);
        }

        flash('Produto Criado com sucesso')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // findOrFail retorna a pagina 404 caso o registro não exista
        $product = $this->product->findOrFail($id);
        $categories = \App\Category::all(['id', 'name']);

        return view('admin.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        
        // pasando um valor padrão null, caso não venha nenhuma categoria no request
        $categories = $request->get('categories', null);

        $product = $this->product->findOrFail($id);
        $product->update($data);

        // o sync ja faz a verificação das categorias adicionadas ou retiradas
        if (!is_null($categories)) {
            $product->categories()->sync($categories);
        }
        
        // verifica se no request existe um upload a ser feito
        if ($request->hasFile('photos')) {
            $images = $this->imageUpload($request->file('photos'), 'image');

            // vinculando imagens ao produto
            // createMany = salva um array
            $product->photos()->createMany($images);
        }

        flash('Produto Atualizado com sucesso')->success();

        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);
        $product->delete();

        flash('Produto Removido com sucesso')->success();

        return redirect()->route('admin.products.index');
    }

    // Agora usando o trait
    // metodo para realizar upload temporario
    // private function imageUpload(Request $request, $imageColumn)
    // {
    //     // captura arquivos do tipo uploadFile (upload de arquivos)
    //     $images = $request->file('photos');
    //     $uploadedImages = [];

    //     foreach ($images as $image) {
    //         // upload na pasta products e disco public
    //         // cria um nome random para o arquivo e já salva com a extensão correta
    //         $uploadedImages[] = [$imageColumn => $image->store('products', 'public')];
    //     }

    //     return $uploadedImages;
    // }
}
