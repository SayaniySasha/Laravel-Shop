<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Picture;

class PicturesController extends Controller
{
    public function index()
    {
        $pictures = Picture::orderBy('id', 'desc')->get();
        return view('admin.pictures.index')
             ->with('pictures', $pictures);
    }
    public function store(Request $request)
    {
        $this->validate(
            $request, 
            [
            'image' => 'required',
            
            ]
        );
    
        if ($request->get('image')) {
            $image = $request->get('image');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            \Image::make($request->get('image'))->save(public_path('images/pictures/').$name);
        }

        $image= new Picture();
        $image->file_name = $name;
        $image->save();

        return response()->json(
            [
            'success' => 'You have successfully uploaded an image',
            ], 
            200
        );
    }
}
