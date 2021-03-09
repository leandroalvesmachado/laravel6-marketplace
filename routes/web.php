<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// GET, POST, PUT, PATCH, DELETE, OPTIONS

Route::get('/', function () {
    return view('welcome');
});

Route::get('/model', function () {
    // $products = \App\Product::all(); -> select * from products
    // \App\User::all() -> select * from users
    // \App\User::find(1) -> retorna o usuário com base no id
    // \App\User::where('name', 'Leandro')->first() -> select * from users where name = 'Leandro'
    // \App\User::paginate(10) -> dados paginados

    // Mass Assignment - Atriubuição em Massa
    // Create a partir dos campos fillable permitidos
    // return object create
    // $user = \App\User::create([
    //     'name' => 'Mass Assignment',
    //     'email' => 'mass@gmail.com',
    //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
    // ]);

    // Mass Update
    // return true or false
    // $user = \App\User::find(42);
    // $user->update([
    //     'name' => 'Mass Update'
    // ]);

    // Como eu faria para recuperar a loja de um usuário
    // $user = \App\User::find(4);
    // return $user->store;

    // Recuperar os produtos de uma loja
    // $loja = \App\Store::find(1);
    // return $loja->products;
    // return $loja->products()->where('product_id', 1)->get();

    // Recuperar os produtos de uma categoria
    // $categoria = \App\Category::find(1);
    // return $categoria->products;

    // Criar uma loja para um usuário
    // $user = \App\User::find(10);
    // $store = $user->store()->create([
    //     'name' => 'Loja Teste',
    //     'description' => 'Loja Teste de produtos de informática',
    //     'phone' => '85-XXXXXXXX',
    //     'mobile_phone' => '85-XXXXXXXX',
    //     'slug' => 'loja-teste'
    // ]);

    // Criar um produto para uma loja
    // $store = \App\Store::find(41);
    // $product = $store->products()->create([
    //     'name' => 'Notebook Dell',
    //     'description' => 'CORE I5 16 GB',
    //     'body' => 'Teste',
    //     'price' => 2999.90,
    //     'slug' => 'notebook-dell'
    // ]);

    // Criar uma categoria
    // \App\Category::create([
    //     'name' => 'Games',
    //     'description' => null,
    //     'slug' => 'games'
    // ]);

    // \App\Category::create([
    //     'name' => 'Notebooks',
    //     'description' => null,
    //     'slug' => 'notebooks'
    // ]);

    // Adicionar um produto para uma categoria ou vice-versa
    // $product = \App\Product::find(49);
    // vinculando a uma ou mais categorias pelo id da categoria
    // $product->categories()->attach([1]);
    // remove o vinculo
    // $product->categories()->detach([1]);

    // adiciona ou vincula as categorias automaticamente
    // inteligente para saber quando remover ou adicionar
    // realiza a sincronização
    // $product->categories()->sync([1, 2]);
});

Route::get('/admin/stores', 'Admin\StoreController@index');
Route::get('/admin/stores/create', 'Admin\StoreController@create');
Route::post('/admin/stores/store', 'Admin\StoreController@store');

// utilizar o namespace, torna-se desnecessario o uso de Admin\StoreController@store
// utilizando o name, podemos simplificar o name da rota, admin.stores.index = index
Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {
    Route::prefix('stores')->name('stores.')->group(function() {
        Route::get('/', 'StoreController@index')->name('index');
        Route::get('/create', 'StoreController@create')->name('create');
        Route::post('/store', 'StoreController@store')->name('store');
        Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        Route::post('/update/{store}', 'StoreController@update')->name('update');
        Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
    });
});

