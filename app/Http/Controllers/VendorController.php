<?php

namespace App\Http\Controllers;

use App\Vendor;
use App\Http\Requests\VendorRequest;
use Illuminate\Support\Facades\Session;


class VendorController extends Controller
{
    public function index()
    {
        return view('back.vendors.index')->withVendors(Vendor::all());
    }

    public function create()
    {
        return view('back.vendors.create');
    }

    public function store(VendorRequest $request)
    {
        $vendor = Vendor::create($request->all());
        $vendor->save();

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El proveedor se ha agregado satisfactoriamente');

        return redirect()->route('vendorBack');
    }

    public function view($id)
    {
        return view('back.vendors.edit')->withVendor(Vendor::findOrFail($id));
    }

    public function edit($id, VendorRequest $request)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($request->all());

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El proveedor se ha modificado satisfactoriamente');

        return redirect()->route('vendorBack');
    }

    public function destroy($id)
    {
        $vendor = Vendor::findOrFail($id);

        // Get products and delete them
        $products = $vendor->products()->get();
        foreach ($products as $product) {
            $product->delete();
        }

        Vendor::destroy($id);

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Aviso!');
        Session::flash('message', 'El proveedor se ha eliminado del sitio');

        return redirect()->route('vendorBack');
    }
}
