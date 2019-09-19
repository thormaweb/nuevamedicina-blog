<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ImageAddRequest;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{
    /**
     * Handling images through ajax in backend edit view
     */

    public function addImage($objectId, ImageAddRequest $request)
    {
        if ($request->typeOf == 'product') {
            $object = Product::findOrFail($objectId);
        } elseif ($request->typeOf == 'otrosmodelo') {
//            $object = OtroModelo::findOrFail($objectId);
        } else {
            return abort(403, 'Modelo no definido.');
        }

        $image = new Image;
        $image->procesImage($request->file('file'), $request->typeOf);
        $image->order = $object->images()->count() + 1;

        $object->images()->create([
            'url' => $image->url,
            'order' => $image->order,
        ]);

        return response()->json([
            'image' => $image = [
                'original' => preg_replace('/('. $request->typeOf .'\/)([0-9\(\)]+)(\-)([^.]*)([^"]*)/', '${4}', $image->url),
                'server' => $image->url,
                'order' => $image->order,
                'size' => File::size(public_path('photos/' . $image->url)),
            ],
        ]);
    }

    public function getImages($objectId, Request $request)
    {
        if ($request->typeOf == 'product') {
            $images = Product::findOrFail($objectId)->images()->ordered()->get();
        } elseif ($request->typeOf == 'otormodelo') {
//            $images = OtroModelo::findOrFail($objectId)->images()->ordered()->get();
        } else {
            return abort(403, 'Modelo no definido.');
        }

        $imageArray = [];
        foreach ($images as $image) {
            $imageArray[] = [
                'original' => preg_replace('/('. $request->typeOf .'\/)([0-9\(\)]+)(\-)([^.]*)([^"]*)/', '${4}', $image->url),
                'server' => $image->url,
                'order' => $image->order,
                'size' => File::size(public_path('photos/' . $image->url))
            ];
        }

        return response()->json([
            'images' => $imageArray,
        ]);
    }

    public function updateImage (Request $request)
    {
        $image = Image::where('url', 'like',
            preg_replace('/(\/photos\/)/', '${2}', $request->imageUrl))->first();

        if(empty($image))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);
        }

        $image->order = $request->order;
        $image->save();

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }

    public function deleteImage (Request $request)
    {
        $image = Image::where('url', 'like', $request->imageUrl)->first();
        if(empty($image))
        {
            return Response::json([
                'error' => true,
                'code'  => 400
            ], 400);
        }

        File::delete(public_path('photos/' . $image->url));

        $image->delete();

        return Response::json([
            'error' => false,
            'code'  => 200
        ], 200);

    }
}
