<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
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
                $data['catgories']=Category::orderBy('id', 'DESC')->paginate($request->show);
                $data['show']=$request->show;

            }elseif(request()->has('query')) {
                $query= preg_replace('/[0-9\@\.\;\" "]+/','', request()->get('query'));
                $data['categories']=Category::where('name', 'LIKE', "%{$query}%")
                ->Orwhere('status', 'LIKE', "%{$query}%")
                ->paginate(10);
            } else {

                $data['categories']=Category::orderBy('id', 'DESC')->paginate(10);
            }
            return view('admin.cms.categories.index', $data);
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
        $data['parentCategories'] = Category::all();
        return view('admin.cms.categories.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryCreateRequest $request)
    {
        try{
            $data = $request->validated();
            if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name'], '-');
            }
            Category::create($data);
            return redirect()->back()->with('success', 'Category been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data['category'] = Category::find($id);
            if(!$data['category']) {
                throw new Exception('Category could not be found on server');
            }
            $data['parentCategories'] = Category::where('id', '!=', $id)->get();

            return view('admin.cms.categories.edit', $data);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryUpdateRequest $request, $id)
    {
        try{
            $category = Category::find($id);
            if(!$category) {
                throw new Exception('Category could not be found on server');
            }
            $data = $request->validated();
            if(empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name'], '-');
            }
            $category->update($data);
            return redirect()->back()->with('success', 'Category has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
        try{
            $category = Category::find($id);

            if(!$category) {
                throw new Exception('Category could not be found on server');
            }
            $category->delete();
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
