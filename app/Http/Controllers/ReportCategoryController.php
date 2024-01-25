<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use App\Models\ReportCategory;
use Illuminate\Http\Request;

class ReportCategoryController extends Controller
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
                $reportCategories = ReportCategory::paginate($request->show);
                $show = $request->show;

            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $reportCategories = ReportCategory::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $reportCategories=ReportCategory::paginate(10);
            }
            return view('admin.report_cat.index')
                        ->with('data',$reportCategories)
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
        return view('admin.report_cat.create');

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
                'slug' => 'nullable|unique:report_categories,slug'
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title).'-'.Str::random(5);

            }

            $report_cat=ReportCategory::create([
                'title'=>$request->title,
                'slug'=>$slug
            ]);
            return redirect()->back()->with('success','Report has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $reportCategory = ReportCategory::find($id);
            if(!$reportCategory) {
                throw new \Exception('Report Category could not be found on server');
            }
            return view('admin.report_cat.edit')
                    ->with('detail',$reportCategory);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $reportCategory = ReportCategory::find($id);
            if(!$reportCategory) {
                throw new \Exception('Report Category could not be found on server');
            }
            $this->validate($request,[
                'title'=>'required',
                'slug' => 'nullable|unique:report_categories,slug,'.$id
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title);
            }
            $input=$request->all();
            $input['slug']=$slug;
            $update=$reportCategory->update($input);
            return redirect()->back()->with('success', 'Report Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReportCategory  $reportCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $reportCategory = ReportCategory::find($id);
            if(!$reportCategory) {
                throw new \Exception('Report Category could not be found on server');
            }
            $reportCategory->delete();
            return redirect()->back()->with('success', 'Report Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
