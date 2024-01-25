<?php

namespace App\Http\Controllers;

use App\Http\Requests\Gallery\GalleryCreateRequest;
use App\Http\Requests\Gallery\GalleryUpdateRequest;
use App\Models\Gallery;
use App\Models\Image;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class GalleryController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if ($request->has('show')) {
                $gallery = Gallery::paginate($request->show);
                $show = $request->show;
            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $gallery = Gallery::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('status', 'LIKE', "%{$query}%")
                ->paginate(10);
            } else {
                $gallery = Gallery::paginate(10);
            }
            return view('admin.gallery.index')
                ->with('data', $gallery)
                ->with('show', @$show);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = GalleryCategory::get();
        return view('admin.gallery.create')
                ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryCreateRequest $request)
    {
        try {
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'gallery');
                $data['image'] = $image['path'];
            }
            $gallery = Gallery::create($data);
            return redirect()->back()->with('success', 'Gallery has been created successfully');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $gallery = Gallery::where('id',$id)->first();
            $categories = GalleryCategory::get();
            return view('admin.gallery.edit')
                    ->with('detail',$gallery)
                    ->with('categories',$categories);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryUpdateRequest $request, $id)
    {
        try {
            $gallery = Gallery::where('id', $id)->first();
            if(!$gallery) {
                throw new \Exception('Gallery could not be found on the server!');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'gallery');
                $data['image'] = $image['path'];
                if ($gallery->image) {
                    unlink(public_path($gallery->image));
                }
            }

            $update = $gallery->update($data);
            return redirect()->back()->with('success', 'Gallery has been updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $gallery = Gallery::where('id', $id)->first();
            if ($gallery->image) {
                unlink(public_path($gallery->image));
            }
            $gallery->delete();
            return redirect()->back()->with('success', 'Gallery has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function images(Request $request,$id)
    {

        $gallery=Gallery::where('id',$id)->first();
        return view('admin.gallery.add_images')
                ->with('gallery',$gallery);

    }

    public function postimages(Request $request){
        $myArray = explode(',', $request->photos);

        foreach($myArray as $key=>$arr)
        {

            $image=Image::where('title',$arr)->first();
            if($image) {
                $image = GalleryImage::create([
                        'title' => "Gallery",
                        'image' => $image->title,
                        'gallery_id' => $request->gallery_id,
                ]);
            }
        }

        return redirect()->back();

    }


    //Update Images
    public function updateimages(Request $request,$id)
    {
        $myArray=explode(',',$request->photos);

        $delete=GalleryImage::where('gallery_id',$id)->get();

        foreach($delete as $del)
        {
            $delete=GalleryImage::find($del->id);
            $delete->delete();
        }
        foreach($myArray as $myarr)
        {
            $delete=GalleryImage::create([
                'image'=>$myarr,
                'gallery_id'=>$id,
                'title'=>'Gallery'
            ]);

        }
        return redirect()->back();

    }


    //Update Images
    public function deleteimage(Request $request,$id)
    {

        return redirect()->back();

    }

    public function storeimages(Request $request,$id)
    {

        $image = $request->file('file');
        if($image){
            $image = $this->uploadImage($image,'gallery/'.$id);
            $path = $image['path'];
            $image = Image::create([
                     'title' => $path,
            ]);
        }

        return response()->json('successfull');
    }

    public function editimages($id)
    {
        $gallery=Gallery::where('id',$id)->first();
        $image=GalleryImage::where('gallery_id',$gallery->id)->get();
        return view('admin.gallery.edit_images')
                ->with('gallery',$gallery)
                ->with('image',$image);
    }

    public function getallImages()
    {
        $images=Image::all();
        return response()->json(['images'=>$images]);
    }

    public function viewimages($id)
    {
        $gallery=Gallery::where('id',$id)->first();
        return view('admin.gallery.edit_images')
                ->with('gallery',$gallery);
    }

    public function getimages(Request $request,$id)
    {
        $images=GalleryImage::where('gallery_id',$id)->get();

        $output = '<div class="row">';
        foreach($images as $image)
        {
            $output .= '
            <div class="col-md-2" style="margin-bottom:16px;" align="center">
                        <img src="'.asset('uploads/galleryimages/' . $image->image).'" class="img-thumbnail" width="175" height="175" style="height:175px;" />
                        <button type="button" class="btn btn-link remove_image" id="'.$image->image.'">Remove</button>
                    </div>
            ';
        }
        $output .= '</div>';
        echo $output;

    }

}
