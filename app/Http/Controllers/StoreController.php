<?php

namespace App\Http\Controllers;

use App\Room;
use App\Vendor;
use App\Product;
use App\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StoreController extends Controller
{
    public function index()
    {
        return view('store.index');
    }

    public function product($vendor, $product)
    {
        return view('store.product')->with('product', Product::where('slug', $product)->firstOrFail());

    }

    public function vendor($vendor)
    {
        return view('store.vendor')->with('vendor', Vendor::where('slug', $vendor)->firstOrFail());
    }

    public function category(Request $request, $category)
    {
        $category = ProductCategory::findBySlugOrFail($category);

        if(sizeof($request->all())){
            $products = $this->filterResults($request, $category);

        } else {

            if ($category->is_parent) {
                $products = Product::whereIn('category_id', $category->categories()->get()->pluck('id'))->paginate(9);
            } else {
                $products = Product::where('category_id', $category->id)->paginate(9);
            }

        }


        return view('store.product_list', compact(['products', 'category']));
    }

    public function subcategory($category, $subcategory)
    {
        $subcategory = ProductCategory::where('slug', $subcategory)->firstOrFail();

        $products = Product::where('category_id', $subcategory->id)->paginate(9);
        $category = $subcategory;

        return view('store.product_list', compact(['products', 'category']));
    }

    public function decoracion()
    {
//        $categoriesIds = Cache::remember('decoracion', 1440, function () { // cache expire in 1 day (1440 min)
//            return $categoriesIds;
//        });

            $categories = ProductCategory::main()
                ->where('slug', 'like', 'productos-decoracion')
                ->firstOrFail()->categories()->ordered()->get();

            $categoriesIds = [];
            foreach ($categories as $category) {
                $categoriesIds[] = $category->id;

                if ($category->is_parent) {
                    foreach ($category->categories()->get() as $childCat) {
                        $categoriesIds[] = $childCat->id;
                    }
                }
            }

        $decoracion = 'Productos de Decoración';
        $products = Product::whereIn('category_id', $categoriesIds)->paginate(9);


        return view('store.product_list', compact(['products', 'decoracion']));
    }

    public function remodelacion()
    {
//        $categoriesIds = Cache::remember('remodelacion', 1440, function () { // cache expire in 1 day (1440 min)
//
//            return $categoriesIds;
//        });

            $categories = ProductCategory::main()
                ->where('slug', 'like', 'productos-remodelacion')
                ->firstOrFail()->categories()->ordered()->get();

            $categoriesIds = [];
            foreach ($categories as $category) {
                if ($category->slug !== 'otros') {// remover categoria Otros
                    $categoriesIds[] = $category->id;

                    if ($category->is_parent) {
                        foreach ($category->categories()->get() as $childCat) {
                            $categoriesIds[] = $childCat->id;
                        }
                    }
                }
            }

        $remodelacion = 'Productos de Remodelación';
        $products = Product::whereIn('category_id', $categoriesIds)->paginate(9);


        return view('store.product_list', compact(['products', 'remodelacion']));
    }

    public function room($room)
    {
        $room = Room::where('slug', $room)->firstOrFail();
        $products = $room->products()->paginate(9);

        return view('store.product_list', compact(['products', 'room']));
    }

    /** Custome filter */

    public function filterResults($request, $category = null)
    {
        $products = (new Product())->newQuery();

        if ($request->has('query')) {

            $algoliaProducts = Product::search($request->get('query'));

            $ids = collect($algoliaProducts->get())->pluck('id');

            $products->whereIn('id', $ids);
        }

        if (isset($category)) {

            if ($category->is_parent) {
                $products = $products->whereIn('category_id', $category->categories()->get()->pluck('id'));
            } else {
                $products = $products->where('category_id', $category->id);
            }
        }

        if ($request->has('destacado')) {
            $products->featuredFirst();
        }

        if ($request->has('espacio')) {
            $products->hasRoom($request->get('espacio'));
        }

        if ($request->has('color')) {
            $products->hasColor($request->get('color'));
        }

        return $products->paginate(9);


    }
}
