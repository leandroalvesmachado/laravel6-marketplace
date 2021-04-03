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

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');

Route::get('/', 'HomeController@index')->name('home');

Route::get('product/{slug}', 'HomeController@single')->name('product.single');

Route::get('/category/{slug}', 'CategoryController@index')->name('category.single');

Route::get('/store/{slug}', 'StoreController@index')->name('store.single');

Route::prefix('cart')->name('cart.')->group(function() {
    Route::get('/', 'CartController@index')->name('index');
    Route::post('add', 'CartController@add')->name('add');
    Route::get('/remove/{slug}', 'CartController@remove')->name('remove');
    Route::get('cancel', 'CartController@cancel')->name('cancel');
});

Route::prefix('checkout')->name('checkout.')->group(function() {
    Route::get('/', 'CheckoutController@index')->name('index');
    Route::post('/proccess', 'CheckoutController@proccess')->name('proccess');
    Route::get('/thanks', 'CheckoutController@thanks')->name('thanks');
    Route::get('/notification', 'CheckoutController@notification')->name('notification');
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

Route::get('my-orders', 'UserOrderController@index')->name('user.orders')->middleware('auth');

// Protegendo rotas para o grupo admin com middleware auth
Route::group(['middleware' => ['auth', 'access.control.store.admin']], function() {
    // Route::get('my-orders', 'UserOrderController@index')->name('user.orders');

    // utilizar o namespace, torna-se desnecessario o uso de Admin\StoreController@store
    // utilizando o name, podemos simplificar o name da rota, admin.stores.index = index
    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() {
        // Route::prefix('stores')->name('stores.')->group(function() {
        //     Route::get('/', 'StoreController@index')->name('index');
        //     Route::get('/create', 'StoreController@create')->name('create');
        //     Route::post('/store', 'StoreController@store')->name('store');
        //     Route::get('/{store}/edit', 'StoreController@edit')->name('edit');
        //     Route::post('/update/{store}', 'StoreController@update')->name('update');
        //     Route::get('/destroy/{store}', 'StoreController@destroy')->name('destroy');
        // });

        Route::resource('stores', 'StoreController');
        Route::resource('products', 'ProductController');
        Route::resource('categories', 'CategoryController');

        Route::post('photos/remove', 'ProductPhotoController@removePhoto')->name('photo.remove');
        Route::get('orders/my', 'OrderController@index')->name('orders.my');
        Route::get('notifications', 'NotificationController@notifications')->name('notifications.index');
        Route::get('notifications/read-all', 'NotificationController@readAll')->name('notifications.read.all');
        Route::get('notifications/read/{notification}', 'NotificationController@read')->name('notifications.read');
    });
});



// Rotas geradas pelo Auth::routes()
// |        | GET|HEAD  | home                          | home                   | App\Http\Controllers\HomeController@index                              | web,auth     |
// |        | GET|HEAD  | login                         | login                  | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest    |
// |        | POST      | login                         |                        | App\Http\Controllers\Auth\LoginController@login                        | web,guest    |
// |        | POST      | logout                        | logout                 | App\Http\Controllers\Auth\LoginController@logout                       | web          |
// |        | GET|HEAD  | model                         |                        | Closure                                                                | web          |
// |        | GET|HEAD  | password/confirm              | password.confirm       | App\Http\Controllers\Auth\ConfirmPasswordController@showConfirmForm    | web,auth     |
// |        | POST      | password/confirm              |                        | App\Http\Controllers\Auth\ConfirmPasswordController@confirm            | web,auth     |
// |        | POST      | password/email                | password.email         | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web          |
// |        | GET|HEAD  | password/reset                | password.request       | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web          |
// |        | POST      | password/reset                | password.update        | App\Http\Controllers\Auth\ResetPasswordController@reset                | web          |
// |        | GET|HEAD  | password/reset/{token}        | password.reset         | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web          |
// |        | GET|HEAD  | register                      | register               | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest    |
// |        | POST      | register                      |                        | App\Http\Controllers\Auth\RegisterController@register                  | web,guest 
Auth::routes();

// middleware para uma rota especifica ou um grupo de rotas
// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
// Route::get('/home', 'HomeController@index')->name('home');

// testando notificacao
Route::get('not', function() {
    // $user = \App\User::find(41);
    // $user->notify(new \App\Notifications\StoreReceiveNewOrder());

    // return $user->notifications;

    // notificacoes nao lidas pelo usuario
    // return $user->unreadNotifications;

    // notificacoes lidas pelo usuario
    // return $user->readNotifications;
});


