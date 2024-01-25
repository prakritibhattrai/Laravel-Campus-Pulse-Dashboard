<?php

namespace App\Http\Controllers;

use App\Models\ResourcesCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResourcesCategoryController extends Controller
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
                $resourceCategories = ResourcesCategory::paginate($request->show);
                $show = $request->show;
            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $resourceCategories = ResourcesCategory::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $resourceCategories = ResourcesCategory::paginate(10);
            }
            return view('admin.resource_cat.index')
                ->with('data', $resourceCategories)
                ->with('show', @$show);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.resource_cat.create');

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
            $this->validate($request, [
                'title' => 'required',
                'slug' => 'nullable|unique:resources_categories,slug',
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{

                $slug=Str::slug($request->title);
            }
            $resource_cat = ResourcesCategory::create([
                'title' => $request->title,
                'slug' => $slug,
            ]);
            return redirect()->back()->with('success', 'Resources Category has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResourcesCategory  $resourcesCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $resourceCategory = ResourcesCategory::find($id);
            if(!$resourceCategory) {
                throw new \Exception('Resource Category could not be found on server');
            }
            return view('admin.resource_cat.edit')
                ->with('detail', $resourceCategory);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResourcesCategory  $resourcesCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $resourceCategory = ResourcesCategory::find($id);
            if(!$resourceCategory) {
                throw new \Exception('Resource Category could not be found on server');
            }
            $this->validate($request, [
                'title' => 'required',
                'slug' => 'nullable|unique:resources_categories,slug,'.$id,
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title);
            }
            $input=$request->all();
            $input['slug']=$slug;
            $update=$resourceCategory->update($input);
            return redirect()->back()->with('success', 'Resources Category has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResourcesCategory  $resourcesCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $resourceCategory = ResourcesCategory::find($id);
            if(!$resourceCategory) {
                throw new \Exception('Resource Category could not be found on server');
            }
            $resourceCategory->delete();
            return redirect()->back()->with('success', 'Resources Category has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
