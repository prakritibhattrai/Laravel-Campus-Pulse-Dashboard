<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeamTypes\TeamTypeCreateRequest;
use App\Http\Requests\TeamTypes\TeamTypeUpdateRequest;
use App\Models\TeamType;
use Illuminate\Support\Str;

class TeamTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            if (request()->has('show')) {
                $data['teamTypes'] = TeamType::paginate(request()->show);
                $data['show'] = request()->show;

            } elseif(request()->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', request()->get('query'));
                $data['teamTypes'] = TeamType::where('name', 'LIKE', "%{$query}%")
                                            ->Orwhere('slug', 'LIKE', "%{$query}%")
                                            ->paginate(10);

            }  else {
                $data['teamTypes'] = TeamType::paginate(10);
            }
            return view('admin.team-types.index',$data);
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
        return view('admin.team-types.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamTypeCreateRequest $request)
    {
        try{
            $data = $request->validated();
            if(empty($data['slug'])) {
            $data['slug'] = Str::slug($data['name'], '-');
            }
            TeamType::create($data);
            return redirect()->back()->with('success', 'Team Type has been created successfully');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error',$e->getMessage());
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
            $data['type'] = TeamType::find($id);
            if(!$data['type']) {
                throw new \Exception('Team Type could not be found on the server!');
            }
            return view('admin.team-types.edit', $data);
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamTypeUpdateRequest $request, $id)
    {
        try {
            $type = TeamType::find($id);
            if(!$type) {
                throw new \Exception('Team Type could not be found on the server!');
            }
            $data = $request->validated();
            if(empty($data['slug'])) {
                $data['slug'] = Str::slug($data['name'], '-');
            }
            $type->update($data);
            return redirect()->back()->with('success', 'Team Type has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
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
        try {
            $type = TeamType::find($id);
            if(!$type) {
                throw new \Exception('Team Type could not be found on the server!');
            }
            $type->delete();
            return redirect()->back()->with('success', 'Team Type has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
