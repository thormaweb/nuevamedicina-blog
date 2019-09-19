<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('inactive')) {
            return view('back.products.index')->with('products', Product::withoutGlobalScopes()->where('enable', 0)->paginate());
        }

        if ($request->has('q')) {
            return view('back.products.index')->with('products', Product::where('name', 'like', '%' . $request->get('q') . '%')->orderBy('created_at', 'desc')->paginate());
        }

        return view('back.products.index')->with('products', Product::orderBy('created_at', 'DESC')->paginate());
    }

    public function create()
    {
        return view('back.products.create');
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->all());

        if ( !is_null($request->get('rooms')) ) {

            $product->rooms()->sync($request->get('rooms'));
        }

        if ( !is_null($request->get('colors')) ) {

            $product->colors()->sync($request->get('colors'));
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El producto se ha agregado satisfactoriamente');

        return redirect()->route('editProduct', ['id' => $product->id]);
    }

    public function view($id)
    {
        return view('back.products.edit')->withProduct(Product::withoutGlobalScopes()->findOrFail($id));
    }

    public function edit($id, ProductRequest $request)
    {
        $product = Product::withoutGlobalScopes()->findOrFail($id);
        $product->update($request->all());

        if(! $request->has('enable')) {
            $product->update(['enable' => 0]);
        }

        if(! $request->has('featured')) {
            $product->update(['featured' => 0]);
        }

        if ( !is_null($request->get('rooms')) ) {

            $product->rooms()->sync($request->get('rooms'));
        }

        if ( !is_null($request->get('colors')) ) {

            $product->colors()->sync($request->get('colors'));
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El producto se ha modificado satisfactoriamente');

        return redirect()->route('productBack');
    }

    public function destroy($id)
    {
        $product = Product::withoutGlobalScopes()->findOrFail($id);

        // Get images and delete them
        $images = $product->images()->get();
        foreach ($images as $image) {
            File::delete(public_path('photos/' . $image->url));
            $image->delete();
        }

        // Finally delete product
        $product->delete();

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Aviso!');
        Session::flash('message', 'El producto se ha eliminado del sitio');

        return redirect()->route('productBack');
    }

    /**
     * Categories ABM
     */

    public function abmCat () {
        if (\Auth::user()->hasRole('admin')) {
            return view('back.products.abm_cat');
        }
    }

    public function storeCat (Request $request) {
        if (\Auth::user()->hasRole('admin')) {

            ProductCategory::create($request->all());

            Session::flash('flash_message', 'success');
            Session::flash('message_strong', 'Bien hecho!');
            Session::flash('message', 'Se creó la categoria');

            return redirect()->route('abmCat');
        }
    }

    public function updateCat (Request $request) {
        if (\Auth::user()->hasRole('admin')) {

            $category = ProductCategory::findOrFail($request->get('category_id'));

            if ($request->get('eliminar') === 'ELIMINAR') {
                ProductCategory::destroy($request->get('category_id'));
            }

            $category->update($request->all());

            Session::flash('flash_message', 'success');
            Session::flash('message_strong', 'Bien hecho!');
            Session::flash('message', 'Se actualizó la categoria');

            return redirect()->route('abmCat');
        }
    }

    public function mergeCat (Request $request) {
        if (\Auth::user()->hasRole('admin')) {
            if ($request->get('seguro') === 'SEGURO') {
                $category = ProductCategory::findOrFail($request->get('merge_this_id'));

                foreach ($category->products()->get() as $product) {
                    $product->update(['category_id' => $request->get('into_this_id')]);
                }
            }

            Session::flash('flash_message', 'success');
            Session::flash('message_strong', 'Bien hecho!');
            Session::flash('message', 'Se actualizó la categoria');

            return redirect()->route('abmCat');
        }
    }
}
