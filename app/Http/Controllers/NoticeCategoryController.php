<?php

namespace App\Http\Controllers;

use App\Models\NoticeCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NoticeCategoryController extends Controller
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
                $categories = NoticeCategory::paginate($request->show);
                $show = $request->show;

            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $categories = NoticeCategory::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);
            } else {
                $categories = NoticeCategory::paginate(10);
            }
            return view('admin.notice.listcategory')
                        ->with('data',$categories)
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
        return view('admin.notice.createcategory');

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
                'slug' => 'nullable|unique:notice_categories,slug'
            ]);
            if($request->slug){
                $slug=$request->slug;
            }else{
                $slug=Str::slug($request->title).'-'.Str::random(5);
            }
            $noticecategory=NoticeCategory::create([
                'title'=>$request->title,
                'slug'=>$slug
            ]);
            if($noticecategory) {
                return redirect()->back()->with('success', 'Notice Category has been created successfully');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\NoticeCategory  $noticeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $noticeCategory=NoticeCategory::find($id);
        if(! $noticeCategory) {
            throw new Exception('Notice Category could not be found on server');
        }
        return view('admin.notice.editcategory')
                ->with('detail',$noticeCategory);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\NoticeCategory  $noticeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $noticeCategory=NoticeCategory::find($id);
            if(! $noticeCategory) {
                throw new Exception('Notice Category could not be found on server');
            }
            $this->validate($request,[
                'title'=>'required',
                'slug' => 'unique:notice_categories,slug,'.$id,
            ]);
            $input=$request->all();
            if($request->slug){
                $input['slug'] = $request->slug;
            }else{
                $input['slug'] = Str::slug($request->title).'-'.Str::random(5);
            }
            $update=$noticeCategory->update($input);
            if($update){
                return redirect()->back()->with('success', 'Notice Category has been updated successfully');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\NoticeCategory  $noticeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $noticeCategory=NoticeCategory::find($id);
            $noticeCategory->delete();
            if(! $noticeCategory) {
                throw new Exception('Notice Category could not be found on server');
            }

            return redirect()->back()->with('success', 'Notice Category has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
