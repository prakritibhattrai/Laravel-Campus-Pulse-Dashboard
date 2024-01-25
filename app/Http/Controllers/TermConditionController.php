<?php

namespace App\Http\Controllers;

use App\Models\TermCondition;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['termCondition'] = TermCondition::first();

        return view('admin.layouts.term-condition', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TermCondition  $termCondition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $termCondition = TermCondition::find($id);
        $this->validate($request,[
            'content'=>'required',
        ]);

        $termCondition->update($request->all());
        return redirect()->back()->with('success', 'Terms and Conditions has been updated successfully');
    }

}
