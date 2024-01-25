<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UserCreateRequest;
use App\Http\Requests\Users\UserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        try {
            $data['users'] = User::paginate(10);
            if (request()->has('show')) {
                $data['users'] = User::paginate(request()->show);
                $data['show'] = request()->show;
            } elseif(request()->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', request()->get('query'));
                $data['users'] = User::where('name', 'LIKE', "%{$query}%")
                                        ->Orwhere('status', 'LIKE', "%{$query}%")
                                        ->Orwhere('position', 'LIKE', "%{$query}%")
                                        ->paginate(10);

            }  else {
                $data['users'] = User::paginate(10);
            }
            return view('admin.users.index',$data);
        } catch (\Exception $e) {

            return redirect()->route('dashboard')->with('error',$e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            User::create($data);
            return redirect()->back()->with('success', 'User has been created successfully');
        } catch (\Exception $e) {
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
        try {
            $data['user'] = User::find($id);
            if(!$data['user']) {
                throw new \Exception('User could not be found on the server!');
            }
           return view('admin.users.edit',$data);
        } catch (\Exception $e) {
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
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $user = User::find($id);
            if(!$user) {
                throw new \Exception('User could not be found on the server!');
            }
            $data = $request->validated();
            $user->update($data);
            return redirect()->back()->with('success','User has been updated successfully');
        } catch (\Exception $e) {
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
        try {
            $user = User::find($id);
            if(!$user) {
                throw new \Exception('User could not be found on the server!');
            }
            $user->delete();
            return redirect()->back()->with('success','User has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
