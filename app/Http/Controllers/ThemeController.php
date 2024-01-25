<?php

namespace App\Http\Controllers;

use App\Http\Requests\Themes\ThemeUpdateRequest;
use App\Models\Theme;
use App\Traits\UploadImage;
use Illuminate\Support\Facades\Request;

class ThemeController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['theme'] = Theme::first();
        return view('admin.designs.layouts.theme', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Theme  $theme
     * @return \Illuminate\Http\Response
     */
    public function update(ThemeUpdateRequest $request, $id)
    {
        try {
            $theme = Theme::find($id);
            if(!$theme) {
                throw new \Exception('Themes could not be found on the server');
            }
            $data = $request->validated();

            if (!empty($data['logo'])) {
                $image = $this->uploadImage($data['logo'],'themes');
                $data['logo'] = $image['path'];
                if ($theme->logo) {
                    unlink(public_path($theme->logo));
                }
            }
            if (!empty($data['footer_logo'])) {
                $image = $this->uploadImage($data['footer_logo'],'themes');
                $data['footer_logo'] = $image['path'];
                if ($theme->footer_logo) {
                    unlink(public_path($theme->footer_logo));
                }
            }
            if (!empty($data['favicon'])) {
                $image = $this->uploadImage($data['favicon'],'themes');
                $data['favicon'] = $image['path'];
                if ($theme->favicon) {
                    unlink(public_path($theme->favicon));
                }
            }

            $theme->update($data);
            return redirect()->back()->with('success', 'Theme has been updated successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove Images from Themes
     *
     * @param Int $id
     */
    public function removeImage($id){

        $theme=Theme::find($id);
        if (request()->name == 'logo') {

            if($theme->logo){
                unlink($theme->logo);
            }
            Theme::where('id', $id)->update(array('logo' => NULL));
        }

        if (request()->name == 'footer_logo') {

            if($theme->footer_logo){
                unlink($theme->footer_logo);
            }
            Theme::where('id', $id)->update(array('footer_logo' => NULL));
        }

        if (request()->name == 'favicon') {

            if($theme->favicon){
                unlink($theme->favicon);
            }
            Theme::where('id', $id)->update(array('favicon' => NULL));
        }

        return json_encode($theme);
    }
}
