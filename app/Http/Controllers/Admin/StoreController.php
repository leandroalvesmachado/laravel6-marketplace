<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use App\Store;

use App\Http\Requests\StoreRequest;

use App\Traits\UploadTrait;


class StoreController extends Controller
{
    use UploadTrait;
    private $store;

    public function __construct(Store $store)
    {
        $this->store = $store;

        // $this->middleware('user.has.store')->only(['create', 'store']);
    }

    public function index()
    {   
        // $stores = $this->store->paginate(10);
        $store = auth()->user()->store;

        return view('admin.stores.index', compact('store'));
    }

    public function create()
    {
        $users = \App\User::all(['id', 'name']);

        return view('admin.stores.create', compact('users'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->all();
        // $user = \App\User::find($data['user']);
        
        // usuario logado
        $user =  auth()->user();

        if ($request->hasFile('logo')) {
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store = $user->store()->create($data);

        flash('Loja criada com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }

    public function edit($store)
    {
        $store = \App\Store::find($store);

        return view('admin.stores.edit', compact('store'));
    }

    public function update(Request $request, $store)
    {
        $data = $request->all();
        $store = \App\Store::find($store);

        if ($request->hasFile('logo')) {
            if (Storage::disk('public')->exists($store->logo)) {
                Storage::disk('public')->delete($store->logo);
            }
            
            $data['logo'] = $this->imageUpload($request->file('logo'));
        }

        $store->update($data);

        flash('Loja Atualizada com sucesso')->success()->important();

        return redirect()->route('admin.stores.index');
    }

    public function destroy($store)
    {
        $store = \App\Store::find($store);
        $store->delete();

        flash('Loja removida com sucesso')->success();

        return redirect()->route('admin.stores.index');
    }
}
