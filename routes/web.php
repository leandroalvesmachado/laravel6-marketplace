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
});
