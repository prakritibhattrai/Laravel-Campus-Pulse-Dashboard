<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\TagCreateRequest;
use App\Http\Requests\Tags\TagUpdateRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
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
                $data['tags']=Tag::orderBy('id', 'DESC')->paginate($request->show);
                $data['show']=$request->show;
            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $data['tags'] = Tag::where('name', 'LIKE', "%{$query}%")
                ->Orwhere('slug', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $data['tags']=Tag::orderBy('id', 'DESC')->paginate(10);
            }
            return view('admin.cms.tags.index', $data);
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
       return view('admin.cms.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        try{
            $data = $request->validated();
            if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name'], '-');
            }
            Tag::create($data);
            return redirect()->back()->with('success', 'Tag has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data['tag'] = Tag::find($id);
            if(!$data['tag']) {
                throw new \Exception('Tag could not be found on the server!');
            }
            return view('admin.cms.tags.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request,$id)
    {
        try{
            $tag = Tag::find($id);
            if(!$tag) {
                throw new \Exception('Tag could not be found on the server!');
            }
            $data = $request->validated();
            if(empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name'], '-');
            }
            $tag->update($data);
            return redirect()->back()->with('success', 'Tag has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $tag = Tag::find($id);
            $tag->delete();
            return redirect()->back()->with('success', 'Tag has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

}
