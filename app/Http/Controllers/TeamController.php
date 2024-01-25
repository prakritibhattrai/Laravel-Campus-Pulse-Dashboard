<?php

namespace App\Http\Controllers;

use App\Http\Requests\Teams\TeamCreateRequest;
use App\Http\Requests\Teams\TeamUpdateRequest;
use App\Models\Team;
use App\Models\TeamType;
use App\Traits\UploadImage;

class TeamController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $data['teams'] = Team::paginate(10);
            if (request()->has('show')) {
                $data['teams'] = Team::paginate(request()->show);
                $data['show'] = request()->show;
            } elseif(request()->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', request()->get('query'));
                $data['teams'] = Team::where('name', 'LIKE', "%{$query}%")
                                        ->Orwhere('status', 'LIKE', "%{$query}%")
                                        ->Orwhere('position', 'LIKE', "%{$query}%")
                                        ->paginate(10);

            }  else {
                $data['teams'] = Team::paginate(10);
            }
            return view('admin.teams.index',$data);
        } catch (\Exception $e) {
            return redirect()->route('home')->with($e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        try {
            $data['types'] = TeamType::all();
            return view('admin.teams.create', $data);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error',$e->getMessage());
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamCreateRequest $request)
    {
        try{
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'teams');
                $data['image'] = $image['path'];
            }

            Team::create($data);
            return redirect()->back()->with('success', 'Team has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data['team'] = Team::find($id);
            if(!$data['team']) {
                throw new \Exception('Team could not be found on the server!');
            }
            $data['types'] = TeamType::all();
            return view('admin.teams.edit', $data);

        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(TeamUpdateRequest $request, $id)
    {
        try{
            $team = Team::find($id);
            if(!$team) {
                throw new \Exception('Team could not be found on the server!');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'teams');
                $data['image'] = $image['path'];

                if ($team->image) {
                    unlink(public_path($team->image));
                }
             }

            $team->update($data);
            return redirect()->back()->with('success', 'Team has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $team = Team::find($id);
            if(!$team) {
                throw new \Exception('Team could not be found on the server!');
            }
            if ($team->image) {
                unlink(public_path($team->image));
            }
            $team->delete();
            return redirect()->back()->with('success', 'Team has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
