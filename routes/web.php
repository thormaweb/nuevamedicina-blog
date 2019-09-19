<?php

Route::get('/', 'PagesController@home');

// Store!
Route::get('tienda', 'StoreController@index')->name('store');
Route::get('tienda/decoracion', 'StoreController@decoracion');
Route::get('tienda/remodelacion', 'StoreController@remodelacion');
Route::get('tienda/categoria/{category}', 'StoreController@category')->name('category');
Route::get('tienda/categoria/{category}/{subcategory}', 'StoreController@subcategory')->name('subcategory');
Route::get('tienda/espacio/{room}', 'StoreController@room')->name('room');
Route::get('tienda/{vendor}', 'StoreController@vendor')->name('vendor');
Route::get('tienda/{vendor}/{product}', 'StoreController@product')->name('product');

// Magazine
Route::get('revista', 'PagesController@magazineIndex');
Route::get('revista/{magazine}', 'PagesController@magazine')->name('magazine');

// Other pages
Route::get('articulos', 'PagesController@blog')->name('articles');
Route::get('articulos/{category}', 'PagesController@articleCategory')->name('articleCategory');
Route::get('articulos/{category}/{article}', 'PagesController@article')->name('article');
Route::get('suscripciones', 'PagesController@suscripciones');
Route::get('directorios', 'PagesController@directorios');
Route::get('contacto', 'PagesController@contacto');
Route::post('contacto', 'PagesController@sendContact');
Route::get('politica-de-privacidad', 'PagesController@privacidad');
Route::get('quienes-somos', 'PagesController@quienes');
Route::get('press', 'PagesController@press');
Route::get('gracias', 'PagesController@gracias');

// Search
Route::get('buscar', 'PagesController@search');

// Auth related
Route::get('dashboard', 'DashboardController@index');
Route::get('ingresar', 'Auth\LoginController@showLoginForm');
Route::post('ingresar', 'Auth\LoginController@login');
Route::get('salir', 'Auth\LoginController@logout');
Auth::routes();

// Sitemaps and SEO
Route::get('sitemap.xml', 'PagesController@index');
Route::get('sitemap_static.xml', 'PagesController@sitemap_static');
Route::get('sitemap_products.xml', 'PagesController@sitemap_products');
Route::get('sitemap_articles.xml', 'PagesController@sitemap_articles');
Route::feeds();

Route::group([

    'prefix' => 'admin',
    'middleware' => 'auth',

], function () {

    Route::get('', function () {

        return view('back.master');
    });

    Route::get('reportes', 'PagesController@report')->name('report');
    Route::get('abm-categorias', 'ProductController@abmCat')->name('abmCat');
    Route::post('abm-categorias', 'ProductController@storeCat');
    Route::post('abm-categorias/update', 'ProductController@updateCat');
    Route::post('abm-categorias/merge', 'ProductController@mergeCat');
    Route::get('process/{slug}', function ($slug){
        $magazine = \App\Magazine::where('slug', $slug)->get()->first();

        dispatch(new \App\Jobs\ProcessPdfImages($magazine));

        return 'Job dispached...';
    });

    Route::group([

        'prefix' => 'usuario',
        'middleware' => ['permission:crudUsers'],

    ], function () {

        Route::get('', 'UserController@index')->name('userBack');
        Route::get('agregar', 'UserController@create')->name('addUser');
        Route::post('agregar', 'UserController@store');
        Route::get('{id}/editar', 'UserController@view')->name('editUser');
        Route::post('{id}/editar', 'UserController@edit');
        Route::post('{id}/borrar', 'UserController@destroy')->name('deleteUser');

    });

    Route::group([

        'prefix' => 'proveedor',
        'middleware' => ['permission:crudVendors'],

    ], function () {

        Route::get('', 'VendorController@index')->name('vendorBack');
        Route::get('agregar', 'VendorController@create')->name('addVendor');
        Route::post('agregar', 'VendorController@store');
        Route::get('{id}/editar', 'VendorController@view')->name('editVendor');
        Route::post('{id}/editar', 'VendorController@edit');
        Route::post('{id}/borrar', 'VendorController@destroy')->name('deleteVendor');

    });

    Route::group([

        'prefix' => 'producto',
        'middleware' => ['permission:crudProducts'],

    ], function () {

        Route::get('', 'ProductController@index')->name('productBack');
        Route::get('agregar', 'ProductController@create')->name('addProduct');
        Route::post('agregar', 'ProductController@store');
        Route::get('{id}/editar', 'ProductController@view')->name('editProduct');
        Route::post('{id}/editar', 'ProductController@edit');
        Route::post('{id}/borrar', 'ProductController@destroy')->name('deleteProduct');

    });

    Route::group([

        'prefix' => 'articulo',
        'middleware' => ['permission:crudArticles'],

    ], function () {

        Route::get('', 'ArticleController@index')->name('articleBack');
        Route::get('agregar', 'ArticleController@create')->name('addArticle');
        Route::post('agregar', 'ArticleController@store');
        Route::get('{id}/editar', 'ArticleController@view')->name('editArticle');
        Route::post('{id}/editar', 'ArticleController@edit');
        Route::post('{id}/borrar', 'ArticleController@destroy')->name('deleteArticle');

    });

    Route::group([

        'prefix' => 'revista',
        'middleware' => ['permission:crudArticles'],

    ], function () {

        Route::get('', 'MagazineController@index')->name('magazineBack');
        Route::get('agregar', 'MagazineController@create')->name('addMagazine');
        Route::post('agregar', 'MagazineController@store');
        Route::get('{id}/editar', 'MagazineController@view')->name('editMagazine');
        Route::post('{id}/editar', 'MagazineController@edit');
        Route::post('{id}/borrar', 'MagazineController@destroy')->name('deleteMagazine');

    });

    Route::group([

        'prefix' => 'slide',
        'middleware' => ['permission:crudSliders'],

    ], function () {

        Route::get('', 'SlideController@index')->name('slideBack');
        Route::get('agregar', 'SlideController@create')->name('addSlide');
        Route::post('agregar', 'SlideController@store');
        Route::get('{id}/editar', 'SlideController@view')->name('editSlide');
        Route::post('{id}/editar', 'SlideController@edit');
        Route::post('{id}/borrar', 'SlideController@destroy')->name('deleteSlide');

    });

    Route::group([

        'prefix'    =>  'images',

    ], function () {

        // Routes for handling images by ajax
        Route::get('{objectId}/all', 'ImageController@getImages');
        Route::post('{objectId}/add', 'ImageController@addImage');
        Route::get('{objectId}/update', 'ImageController@updateImage');
        Route::get('{objectId}/delete', 'ImageController@deleteImage');

    });

});


/** Redirects from old Joomla */

Route::get('/galerias/{remodelacion}', function(){
    return redirect('/articulos/remodelacion', 301);
})->where('remodelacion', 'remodelacion.*');

Route::get('/galerias/{casas}', function(){
    return redirect('/articulos/casas', 301);
})->where('casas', 'casas.*');

Route::get('/galerias/{muebles}', function(){
    return redirect('/articulos/muebles-y-decoracion', 301);
})->where('muebles', 'muebles-y-decoracion.*');

Route::get('/galerias/{comunicados}', function(){
    return redirect('/articulos/lo-que-esta-pasando', 301);
})->where('comunicados', 'comunicados-y-sociales.*');

Route::get('/galerias/{diseno}', function(){
    return redirect('/articulos/diseno-local-e-internacional', 301);
})->where('diseno', 'diseno-local-e-internacional.*');

Route::get('/galerias/{paladar}', function(){
    return redirect('/articulos/paladar', 301);
})->where('paladar', 'paladar.*');

Route::get('{directorios}', function(){
    return redirect('/directorios', 301);
})->where('directorios', 'directorio-de-decoradores-arquitectos.*');

Route::get('/component/{xxx}', function(){
    return redirect('/tienda', 301);
})->where('xxx', '.*');

Route::get('{xxx}', function(){
    return redirect('/articulos', 301);
})->where('xxx', 'extras-mdv.*');

Route::get('{xxx}', function(){
    return redirect('/articulos', 301);
})->where('xxx', 'modo-de-vida-digital.*');
