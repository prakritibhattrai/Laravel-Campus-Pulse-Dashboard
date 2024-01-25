<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\SettingUpdateRequest;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['setting'] = Setting::first();
        return view('admin.designs.layouts.setting', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(SettingUpdateRequest $request, $id)
    {
        $setting = Setting::find($id);
        $data = $request->validated();
        $data = array_merge($data, [
            'cache' => empty($data['cache']) ? 0 : $data['cache'],
            'minify' => empty($data['minify']) ? 0 : $data['minify'],
            'maintenance' => empty($data['maintenance']) ? 0 : $data['maintenance'],
            'use_ssl' => empty($data['use_ssl']) ? 0 : $data['use_ssl'],
            'app_debug' => empty($data['app_debug']) ? 0 : $data['app_debug'],
            'google_recaptcha' => empty($data['google_recaptcha']) ? 0 : $data['google_recaptcha'],
        ]);

        if (isset($data['maintenance']) && $data['maintenance'] == 1) {
            Artisan::call('down');
        } else {
            Artisan::call('up');
        }

        $setting->update($data);

        return redirect()->back()->with('success', 'Settings has been updated successfully');
    }

}
