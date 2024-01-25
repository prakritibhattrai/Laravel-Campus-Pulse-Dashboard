<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use Exception;
use Illuminate\Http\Request;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $data['aboutus'] = AboutUs::first();
            return view('admin.layouts.aboutus', $data);

        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutUs  $aboutUs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $aboutUs = AboutUs::find($id);
            if(!$aboutUs) {
                throw new Exception('About Us could not be found on server');
            }
            $this->validate($request,[
                'content'=>'required|string',
            ]);
            $data = $request->all();
            $aboutUs->update($data);
            return redirect()->back()->with('success', 'AboutUs has been updated successfully');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
