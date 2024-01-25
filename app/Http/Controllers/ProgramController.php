<?php

namespace App\Http\Controllers;

use App\Http\Requests\Programs\ProgramCreateRequest;
use App\Http\Requests\Programs\ProgramUpdateRequest;
use App\Models\Level;
use App\Models\Program;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use Exception;

class ProgramController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            if ($request->has('show')) {
                $programs = Program::paginate($request->show);
                $show = $request->show;

            }elseif($request->has('query')) {
                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $programs = Program::where('title', 'LIKE', "%{$query}%")
                                        ->Orwhere('status', 'LIKE', "%{$query}%")
                                        ->paginate(10);
            } else {
                $programs = Program::paginate(10);
            }
            return view('admin.program.index')
                ->with('data', $programs)
                ->with('show', @$show);
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
        $levels = Level::get();
        return view('admin.program.create')
            ->with('levels', $levels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProgramCreateRequest $request)
    {
        try {
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'levels');
                $data['image'] = $image['path'];
            }
            $program = Program::create($data);
            return redirect()->back()->with('success','Program has been created successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $program = Program::find($id);
            if(!$program) {
                throw new \Exception('Program could not be found on server');
            }
            $levels = Level::get();
            return view('admin.program.edit')
                ->with('detail', $program)
                ->with('levels', $levels);
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(ProgramUpdateRequest $request, $id)
    {
        try {
            $program = Program::find($id);
            if(!$program) {
                throw new \Exception('Program could not be found on server');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'levels');
                $data['image'] = $image['path'];

                if ($program->image) {
                    unlink(public_path($program->image));
                }
            }
            $update = $program->update($data);
            return redirect()->back()->with('success', 'Program has been updated successfully');
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $program = Program::find($id);
            if(!$program) {
                throw new \Exception('Program could not be found on server');
            }
            if ($program->image) {
                unlink(public_path($program->image));
            }
            $program->delete();
            return redirect()->back()->with('success', 'Program has been deleted successfully');;
        } catch(Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
