<?php

namespace App\Http\Controllers;

use App\Models\PublicationCategory;
use App\Models\Research;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublicationCategoryController extends Controller
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
                $publication_cat=PublicationCategory::paginate($request->show);
                $show=$request->show;

            }elseif($request->has('query')) {
                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $publication_cat = PublicationCategory::where('title', 'LIKE', "%{$query}%")
                                        ->Orwhere('slug', 'LIKE', "%{$query}%")
                                        ->paginate(10);
            } else {
                $publication_cat=PublicationCategory::paginate(10);
            }
            return view('admin.publication_cat.index')
                        ->with('data',$publication_cat)
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
        return view('admin.publication_cat.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->validate($request,[
                'title'=>'required',
                'slug' => 'nullable|unique:publication_categories,slug'
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title).'-'.Str::random(5);
            }
            $publication_cat=PublicationCategory::create([
                'title'=>$request->title,
                'slug'=>$slug
            ]);

            return redirect()->back()->with('success' ,'Publication Category has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicationCategory  $publicationCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $publicationCategory = PublicationCategory::find($id);
            if(!$publicationCategory) {
                throw new \Exception('Publication Category could not be found on server');
            }
            return view('admin.publication_cat.edit')
                    ->with('detail',$publicationCategory);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicationCategory  $publicationCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $publicationCategory = PublicationCategory::find($id);
            if(!$publicationCategory) {
                throw new \Exception('Publication Category could not be found on server');
            }

            $this->validate($request,[
                'title'=>'required',
                'slug' => 'nullable|unique:publication_categories,slug,'.$id
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title);
            }
            $input=$request->all();
            $input['slug']=$slug;
            $update=$publicationCategory->update($input);
            return redirect()->back()->with('success' ,'Publication Category has been updated successfully');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicationCategory  $publicationCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $publicationCategory=PublicationCategory::find($id);
            if(!$publicationCategory) {
                throw new \Exception('Publication Category could not be found on server');
            }
            $publicationCategory->delete();

            return redirect()->back()->with('success' ,'Publication Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
