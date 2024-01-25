<?php

namespace App\Http\Controllers;

use App\Http\Requests\Publications\PublicationCreateRequest;
use App\Http\Requests\Publications\PublicationUpdateRequest;
use App\Models\Publication;
use App\Models\PublicationCategory;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class PublicationController extends Controller
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
                $publications = Publication::paginate($request->show);
                $show = $request->show;

            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $publications = Publication::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('category_id', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $publications = Publication::paginate(10);
            }
            return view('admin.publication.index')
                ->with('data', $publications)
                ->with('show', @$show)
                ->with('show', @$query);
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
        $categories = PublicationCategory::get();
        return view('admin.publication.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PublicationCreateRequest $request)
    {
        try {
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'publications');
                $data['image'] = $image['path'];
            }
            if (!empty($data['file'])) {
                $file = $this->uploadImage($data['file'],'publications');
                $data['file'] = $file['path'];
            }
            $publication = Publication::create($data);

            return redirect()->back()->with('success', 'Publication has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $publication = Publication::find($id);
            if(!$publication) {
                throw new \Exception('Publication could not be found on server');
            }
            $categories = PublicationCategory::get();
            return view('admin.publication.edit')
                ->with('detail', $publication)
                ->with('categories', $categories);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function update(PublicationUpdateRequest $request,$id)
    {
        try {
            $publication = Publication::find($id);
            if(!$publication) {
                throw new \Exception('Publication could not be found on server');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'publications');
                $data['image'] = $image['path'];

                if ($publication->image) {
                    unlink(public_path($publication->image));
                }
            }
            if (!empty($data['file'])) {
                $file = $this->uploadImage($data['file'],'publications');
                $data['file'] = $file['path'];

                if ($publication->file) {
                    unlink(public_path($publication->file));
                }
            }
            $update = $publication->update($data);
            return redirect()->back()->with('success', 'Publication has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publication  $publication
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $publication = Publication::find($id);
            if(!$publication) {
                throw new \Exception('Publication could not be found on server');
            }
            if ($publication->image) {
                unlink(public_path($publication->image));
            }
            if ($publication->file) {
                unlink(public_path($publication->file));
            }
            $publication->delete();
            return redirect()->back()->with('success', 'Publication has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
