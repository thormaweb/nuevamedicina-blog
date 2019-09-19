<?php

namespace App\Http\Controllers;

use App\Magazine;
use App\Jobs\ProcessPdfImages;
use App\Http\Requests\MagazineRequest;
use Illuminate\Support\Facades\Session;

class MagazineController extends Controller
{
    public function index()
    {
        return view('back.magazines.index')
                ->with('magazines', Magazine::withoutGlobalScopes()
                ->orderBy('order', 'DESC')
                ->paginate(6)
                );

    }

    public function create()
    {
        return view('back.magazines.create');
    }

    public function store(MagazineRequest $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $fileName = $year . '_' . $month;

        $magazine = new Magazine;
        $magazine->name = Magazine::$months[$month] . ' ' . $year;
        $magazine->slug = $year . '-' . Magazine::$months[$month];
        $magazine->order = $year . $month;
        $magazine->keywords = '';
        $magazine->published_on = $request->get('published_on');
        $magazine->procesImage($request->file('thumbnail'), $fileName);

        if($request->has('issuu_active')) {
            $magazine->issuu_active = $request->get('issuu_active');
            $magazine->issuu_script = $request->get('issuu_script');
            $magazine->description = '';
            $magazine->pdf = '';
            $magazine->save();
        } else {

            $magazine->description = $request->get('description');
            $magazine->procesPdf($request->file('pdf'), $fileName);
            $magazine->save();
            dispatch(new ProcessPdfImages($magazine));
        }


        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'La revista se ha agregado satisfactoriamente');

        return redirect()->route('magazineBack');
    }

    public function view($id)
    {
        return view('back.magazines.edit')->with('magazine', Magazine::withoutGlobalScopes()->findOrFail($id));
    }

    public function edit($id, MagazineRequest $request)
    {
        $month = $request->get('month');
        $year = $request->get('year');
        $fileName = $year . '_' . $month;

        $magazine = Magazine::withoutGlobalScopes()->findOrFail($id);
        $magazine->published_on = $request->get('published_on');

        if($request->has('issuu_active')) {
            $magazine->issuu_script = $request->get('issuu_script');
            $magazine->issuu_active = $request->get('issuu_active');
            $magazine->save();
        } else {
            $magazine->issuu_active = false;
            $magazine->description = $request->get('description');
        }



        if($request->hasFile('thumbnail')){
            $magazine->procesImage($request->file('thumbnail'), $fileName);
        }

        if($request->hasFile('pdf')){
            $magazine->procesPdf($request->file('pdf'), $fileName);
            $magazine->save();

            dispatch(new ProcessPdfImages($magazine));
        } else {
            $magazine->save();
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'La revista se ha actualizado');

        return redirect()->route('magazineBack');
    }

    public function destroy($id)
    {
        Magazine::withoutGlobalScopes()->where('id', $id)->delete();

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Atención!');
        Session::flash('message', 'La revista se ha eliminado');

        return redirect()->route('magazineBack');
    }
}
