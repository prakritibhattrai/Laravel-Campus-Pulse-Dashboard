<?php

namespace App\Http\Controllers;
use App\Models\GalleryCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GalleryCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('show')) {
                $gallery_cat=GalleryCategory::paginate($request->show);
                $show=$request->show;
            }elseif($request->has('query')) {

                $query= preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $gallery_cat=GalleryCategory::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);
            } else {
                $gallery_cat=GalleryCategory::paginate(10);
            }
            return view('admin.gallery_cat.index')
                        ->with('data',$gallery_cat)
                        ->with('show',@$show);
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
        return view('admin.gallery_cat.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $this->validate($request,[
                'title'=>'required',
                'slug' => 'nullable|unique:resources_categories,slug',
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title).'-'.Str::random(5);

            }

            $publication_cat=GalleryCategory::create([
                'title'=>$request->title,
                'slug'=>$slug
            ]);

            return redirect()->back()->with('success', 'Gallery Category has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $galleryCategory=GalleryCategory::find($id);
            if(!$galleryCategory) {
                throw new Exception('Gallery Category could not be found on server');
            }
            return view('admin.gallery_cat.edit')
                    ->with('detail',$galleryCategory);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $gallery_cat=GalleryCategory::find($id);
            if(!$gallery_cat) {
                throw new Exception('Gallery Category could not be found on server');
            }
            $this->validate($request,[
                'title'=>'required',
                'slug' => 'nullable|unique:resources_categories,slug,'.$id,
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title);
            }
            $input=$request->all();
            $input['slug']=$slug;
            $update=$gallery_cat->update($input);
            return redirect()->back()->with('success', 'Gallery Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GalleryCategory  $galleryCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $galleryCategory = GalleryCategory::find($id);
            if(!$galleryCategory) {
                throw new Exception('Gallery Category could not be found on server');
            }
            $galleryCategory->delete();
            return redirect()->back()->with('success', 'Gallery Category has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }
}
