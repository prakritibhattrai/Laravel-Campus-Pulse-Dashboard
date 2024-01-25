<?php

namespace App\Http\Controllers;

use App\Http\Requests\Research\ResearchCreateRequest;
use App\Http\Requests\Research\ResearchUpdateRequest;
use App\Models\Research;
use App\Models\ResearchCategory;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class ResearchController extends Controller
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
                $researchs = Research::paginate($request->show);
                $show = $request->show;
            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $researchs = Research::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('status', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $researchs = Research::paginate(10);
            }
            return view('admin.research.index')
                ->with('data', $researchs)
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
        $categories=ResearchCategory::get();
        return view('admin.research.create')
                ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ResearchCreateRequest $request)
    {
        try{
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'research');
                $data['image'] = $image['path'];
            }

            $research = Research::create($data);

            return redirect()->back()->with('success', 'Research has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $research = Research::find($id);
            if(!$research) {
                throw new \Exception('Research could not be found on server');
            }
            $categories=ResearchCategory::get();
            return view('admin.research.edit')
                    ->with('detail',$research)
                    ->with('categories',$categories);

        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function update(ResearchUpdateRequest $request,$id)
    {
        try {
            $research = Research::find($id);
            if(!$research) {
                throw new \Exception('Research could not be found on server');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'research');
                $data['image'] = $image['path'];

                if ($research->image) {
                    unlink(public_path($research->image));
                }
            }
            $research->update($data);

            return redirect()->back()->with('success', 'Research has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Research  $research
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $research = Research::find($id);
            if(!$research) {
                throw new \Exception('Research could not be found on server');
            }
            if ($research->image) {
                unlink(public_path($research->image));
            }
            $research->delete();
            return redirect()->back()->with('success', 'Research has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
