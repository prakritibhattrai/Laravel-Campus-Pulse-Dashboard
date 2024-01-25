<?php

namespace App\Http\Controllers;

use App\Http\Requests\Notices\NoticeCreateRequest;
use App\Http\Requests\Notices\NoticeUpdateRequest;
use App\Models\Notice;
use App\Models\NoticeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Traits\UploadImage;
use Exception;

class NoticeController extends Controller
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
                $notices=Notice::paginate($request->show);
                $show=$request->show;
            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $notices = Notice::where('title', 'LIKE', "%{$query}%")
                                        ->Orwhere('status', 'LIKE', "%{$query}%")
                                        ->paginate(10);
            }else {
                $notices=Notice::paginate(10);
            }
            return view('admin.notice.index')
                        ->with('data',$notices)
                        ->with('show',@$show);
        } catch(Exception $e) {
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
        $categories=NoticeCategory::get();
        return view('admin.notice.create')
                ->with('categories',$categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeCreateRequest $request)
    {
        try{
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'notices');
                $data['image'] = $image['path'];
            }
            $notice=Notice::create($data);

            return redirect()->back()->with('success', 'Notice has been created successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $notice=Notice::find($id);
            if(!$notice) {
                throw new Exception('Notice could not be found on server');
            }
            $categories=NoticeCategory::all();
            return view('admin.notice.edit')
                        ->with('detail',$notice)
                        ->with('categories',$categories);
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(NoticeUpdateRequest $request, $id)
    {
        try{
            $notice = Notice::find($id);
            if(!$notice) {
                throw new Exception('Notice could not be found on server');
            }
            $data = $request->validated();
            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'], 'notices');
                $data['image'] = $image['path'];

                if ($notice->image) {
                    unlink(public_path($notice->image));
                }
            }
            $update=$notice->update($data);
            return redirect()->back()->with('success', 'Notice has been updated successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $notice = Notice::find($id);
            if(!$notice) {
                throw new Exception('Notice could not be found on server');
            }
            if($notice->image){
                unlink(public_path($notice->image));
            }
            $notice->delete();
            return redirect()->back()->with('success', 'Notice has been deleted successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

}
