<?php

namespace App\Http\Controllers;

use App\Image;
use App\Slide;
use Illuminate\Support\Facades\File;
use App\Http\Requests\SlideRequest;
use Illuminate\Support\Facades\Session;

class SlideController extends Controller
{
    public function index()
    {
        return view('back.slides.index')->with('slides', Slide::ordered()->get());
    }

    public function create()
    {
        return view('back.slides.create');
    }

    public function store(SlideRequest $request)
    {
        $slide = Slide::create($request->all());

        if ($request->hasFile('image')) {
            $image = new Image;
            $image->procesImage($request->file('image'), 'slides', 1200, 600);
            $slide->image = $image->url;
            $slide->save();
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El slider se ha agregado satisfactoriamente');

        return redirect()->route('slideBack');
    }

    public function view($id)
    {
        return view('back.slides.edit')->withSlide(Slide::findOrFail($id));
    }

    public function edit($id, SlideRequest $request)
    {
        $slide = Slide::findOrFail($id);
        $slide->update($request->all());

        if ($request->hasFile('image')) {

            File::delete(public_path('photos/' . $slide->image));

            $image = new Image;
            $image->procesImage($request->file('image'), 'slides', 1200, 600);
            $slide->image = $image->url;
            $slide->save();
        }

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Bien hecho!');
        Session::flash('message', 'El slider se ha modificado satisfactoriamente');

        return redirect()->route('slideBack');
    }

    public function destroy($id)
    {
        $slide = Slide::findOrFail($id);

        // Get images and delete them
        File::delete(public_path('photos/' . $slide->image));

        // Finally delete slide
        Slide::destroy($id);

        Session::flash('flash_message', 'success');
        Session::flash('message_strong', 'Aviso!');
        Session::flash('message', 'El slider se ha eliminado del sitio');

        return redirect()->route('slideBack');
    }
}
