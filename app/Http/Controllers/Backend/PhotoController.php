<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(20);
        return view('backend.photo.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:120',
            'description' => 'required|min:3|max:200',
            'image' => 'required|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $fileName = $image->hashName();

        $format = $request->image->getClientOriginalExtension();
        $size = $request->image->getSize();

        $path = 'uploads/' . $fileName;
        $pathBigImage = 'uploads/1280x1024/' . $fileName;
        $pathMediumImage = 'uploads/316x255/' . $fileName;
        $pathSmallImage = 'uploads/118x95/' . $fileName;
        Image::make($image->getRealPath())->resize(800, 600)->save($path);
        Image::make($image->getRealPath())->resize(1280, 1024)->save($pathBigImage);
        Image::make($image->getRealPath())->resize(316, 255)->save($pathMediumImage);
        Image::make($image->getRealPath())->resize(118, 95)->save($pathSmallImage);
        $photo = new Photo;
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->file = $fileName;
        $photo->format = $format;
        $photo->size = $size;

        $photo->save();
        return redirect()->back()->with('message', 'Wallpaper Uploaded Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $photo = Photo::find($id);
        return view('backend.photo.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:3|max:100',
            'description' => 'required|min:3|max:500',
        ]);

        $photo = Photo::find($id);
        $fileName = $photo->file;
        $format = $photo->format;
        $size = $photo->size;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileNewName = $image->hashName();
            $format = $request->image->getClientOriginalExtension();
            $size = $request->image->getSize();
            $path = 'uploads/' . $fileNewName;
            $pathBigImage = 'uploads/1280x1024/' . $fileNewName;
            $pathMediumImage = 'uploads/316x255/' . $fileNewName;
            $pathSmallImage = 'uploads/118x95/' . $fileNewName;
            Image::make($image->getRealPath())->resize(800, 600)->save($path);
            Image::make($image->getRealPath())->resize(1280, 1024)->save($pathBigImage);
            Image::make($image->getRealPath())->resize(316, 255)->save($pathMediumImage);
            Image::make($image->getRealPath())->resize(118, 95)->save($pathSmallImage);
            unlink(public_path('/uploads/' . $photo->file));
            unlink(public_path('/uploads/1280x1024/' . $photo->file));
            unlink(public_path('/uploads/316x255/' . $photo->file));
            unlink(public_path('/uploads/118x95/' . $photo->file));
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->file = $fileNewName;
            $photo->format = $format;
            $photo->size = $size;
            $photo->save();
            return redirect()->back()->with('message', "Photo Updated Successfully!");
        } else {
            $photo->title = $request->get('title');
            $photo->description = $request->get('description');
            $photo->file = $fileName;
            $photo->format = $format;
            $photo->size = $size;
            $photo->save();
            return redirect()->back()->with('message', "Photo Updated Successfully!");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $photo = Photo::find($id);
        $photo->delete();
        unlink(public_path('/uploads/' . $photo->file));
        unlink(public_path('/uploads/1280x1024/' . $photo->file));
        unlink(public_path('/uploads/316x255/' . $photo->file));
        unlink(public_path('/uploads/118x95/' . $photo->file));
        return redirect()->back()->with('message', "Photo Deleted Successfully!");
    }
}
