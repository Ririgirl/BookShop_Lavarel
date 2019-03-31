<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
use DB;
use Intervention\Image\Facades\Image as ImageInt;
class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index',compact('images'));
    }
    public function create()
    {
        return view('images.create');
    }
    public function store(Request $request)
    {
        $path =public_path('upload\\');
        $file = $request->file('file');
        foreach ($file as $f) {
            $filename = str_random(20) .'.' . $f->getClientOriginalExtension() ?: 'png';
            $img = ImageInt::make($f);
            $img->resize(200,300)->save($path . $filename);
            Image::create(['img' => $filename]);
        }
        return redirect()->route('images.index');
    }
}
