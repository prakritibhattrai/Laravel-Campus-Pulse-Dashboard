<?php

namespace App\Http\Controllers;

use App\Http\Requests\Levels\LevelCreateRequest;
use App\Http\Requests\Levels\LevelUpdateRequest;
use App\Models\Level;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use Exception;

class LevelController extends Controller
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
                $levels=Level::paginate($request->show);
                $show=$request->show;
            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $levels = Level::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('description', 'LIKE', "%{$query}%")
                ->paginate(10);
            } else {
                $levels=Level::paginate(10);
            }
            return view('admin.level.index')
                        ->with('data',$levels)
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
        return view('admin.level.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LevelCreateRequest $request)
    {
        try{
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'levels');
                $data['image'] = $image['path'];
            }
            $level=Level::create($data);
            if($level){
                return redirect()->back()->with('success','Level has been created successfully');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['level'] = Level::find($id);
        if(!$data['level']) {
            throw new Exception('Level could not be found on server');
        }
        return view('admin.level.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function update(LevelUpdateRequest $request, $id)
    {
        try{
            $level=Level::where('id',$id)->first();
            if(!$level) {
                throw new Exception('Level could not be found on server');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'levels');
                $data['image'] = $image['path'];

                if ($level->image) {
                    unlink(public_path($level->image));
                }
            }
            $update=$level->update($data);
            if($update){
                return redirect()->back()->with('success','Level has been updated successfully');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Level  $level
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $level=Level::where('id',$id)->first();
            if(!$level) {
                throw new Exception('Level could not be found on server');
            }
            if($level->image){
                unlink(public_path($level->image));
            }
            $level->delete();
            return redirect()->back()->with('success', 'Level has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
