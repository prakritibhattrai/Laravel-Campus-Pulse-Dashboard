<?php

namespace App\Http\Controllers;

use App\Http\Requests\Downloads\DownloadCreateRequest;
use App\Http\Requests\Downloads\DownloadUpdateRequest;
use App\Models\Download;
use App\Models\ResourcesCategory;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class DownloadController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('show')) {
            $downloads = Download::paginate($request->show);
            $show = $request->show;
        }elseif($request->has('query')){

            $query= preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
            $downloads=Download::where('title', 'LIKE', "%{$query}%")
            ->Orwhere('status', 'LIKE', "%{$query}%")
            ->paginate(10);
        }else{
            $downloads = Download::paginate(10);
        }
        return view('admin.download.index')
            ->with('data', $downloads)
            ->with('show', @$show);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = ResourcesCategory::get();
        return view('admin.download.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DownloadCreateRequest $request)
    {
        try {
            $data = $request->validated();
            if (!empty($data['file'])) {
                $file = $this->uploadImage($data['file'],'downloads');
                $data['file'] = $file['path'];
            }
            $download = Download::create($data);
            return redirect()->back()->with('success','Download has been created successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $download = Download::find($id);
            if(!$download) {
                throw new \Exception('Download could not be found on the server!');
            }
            $categories = ResourcesCategory::get();
            return view('admin.download.edit')
                ->with('detail', $download)
                ->with('categories', $categories);
        } catch(\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function update(DownloadUpdateRequest $request,$id)
    {
        try {
            $download = Download::find($id);
            if(!$download) {
                throw new \Exception('Download could not be found on the server!');
            }
            $data = $request->validated();

            if (!empty($data['file'])) {
                $file = $this->uploadImage($data['file'],'downloads');
                $data['file'] = $file['path'];

                if ($download->file) {
                    unlink(public_path($download->file));
                }
            }
            $update = $download->update($data);
            return redirect()->back()->with('success','Download has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Download  $download
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $download = Download::find($id);

            if(!$download) {
                throw new \Exception('Download could not be found on the server!');
            }
            if ($download->file) {
                unlink(public_path($download->file));
            }
            $download->delete();
            return redirect()->back()->with('success','Download has been deleted successfully');

        } catch(\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
