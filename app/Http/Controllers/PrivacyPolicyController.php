<?php

namespace App\Http\Controllers;

use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            $data['privacyPolicy'] = PrivacyPolicy::first();
            return view('admin.layouts.privacy-policy', $data);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PrivacyPolicy  $privacyPolicy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id )
    {
        try{
            $privacyPolicy = PrivacyPolicy::find($id);
            $this->validate($request,[
                'content'=>'required',
            ]);

            $privacyPolicy->update($request->all());
            return redirect()->back()->with('success', 'Privacy Policy has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
