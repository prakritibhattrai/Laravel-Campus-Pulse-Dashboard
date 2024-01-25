<?php

namespace App\Http\Controllers;

use App\Models\ResearchCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ResearchCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if ($request->has('show')) {
                $researchCategories = ResearchCategory::paginate($request->show);
                $show = $request->show;

            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $researchCategories = ResearchCategory::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $researchCategories = ResearchCategory::paginate(10);
            }
            return view('admin.research_cat.index')
                ->with('data', $researchCategories)
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
        return view('admin.research_cat.create');
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
            $this->validate($request, [
                'title' => 'required',
                'slug' => 'nullable|unique:research_categories,slug',
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{

                $slug=Str::slug($request->title);
            }
            $research_cat = ResearchCategory::create([
                'title' => $request->title,
                'slug' => $slug,
            ]);
            return redirect()->back()->with('success', 'Research Categpry has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ResearchCategory  $researchCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $researchCategory = ResearchCategory::find($id);
            if(!$researchCategory) {
                throw new \Exception('Research Category could not be found on server');
            }
            return view('admin.research_cat.edit')
                ->with('detail', $researchCategory);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ResearchCategory  $researchCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $researchCategory = ResearchCategory::find($id);
            if(!$researchCategory) {
                throw new \Exception('Research Category could not be found on server');
            }
            $this->validate($request, [
                'title' => 'required',
                'slug' => 'nullable|unique:research_categories,slug,'.$id,

            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title);
            }
            $input=$request->all();
            $input['slug']=$slug;
            $update=$researchCategory->update($input);

            return redirect()->back()->with('success', 'Research Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ResearchCategory  $researchCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $researchCategory = ResearchCategory::find($id);
            if(!$researchCategory) {
                throw new \Exception('Research Category could not be found on server');
            }
            $researchCategory->delete();
            return redirect()->back()->with('success', 'Research Category has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
