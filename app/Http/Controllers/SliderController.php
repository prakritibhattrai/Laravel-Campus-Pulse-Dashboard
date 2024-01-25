<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sliders\SliderCreateRequest;
use App\Http\Requests\Sliders\SliderUpdateRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class SliderController extends Controller
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
            $data['sliders'] = Slider::paginate(10);
            if (request()->has('show')) {
                $data['sliders'] = Slider::paginate(request()->show);
                $data['show'] = request()->show;
            } elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $data['sliders'] = Slider::where('name', 'LIKE', "%{$query}%")
                ->Orwhere('status', 'LIKE', "%{$query}%")
                ->Orwhere('link', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $data['sliders'] = Slider::paginate(10);
            }
            return view('admin.designs.layouts.sliders.index', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.designs.layouts.sliders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderCreateRequest $request)
    {
        try{
            $data = $request->validated();
            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'sliders');
                $data['image'] = $image['path'];
            }

            Slider::create($data);
            return redirect()->back()->with('success', 'Slider has been created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $data['slider'] = Slider::find($id);
            if(!$data['slider']) {
                throw new \Exception('Slider could not be found on the server!');
            }
            return view('admin.designs.layouts.sliders.edit', $data);
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(SliderUpdateRequest $request, $id)
    {
        try{
            $slider = Slider::find($id);
            if(!$slider) {
                throw new \Exception('Slider could not be found on the server!');
            }
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'sliders');
                $data['image'] = $image['path'];

                if ($slider->image) {
                    unlink(public_path($slider->image));
                }
            }

            $slider->update($data);
            return redirect()->back()->with('success', 'Slider has been updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::find($id);
            if(!$slider) {
                throw new \Exception('Slider could not be found on the server!');
            }
            if ($slider->image) {
                unlink(public_path($slider->image));
            }
            $slider->delete();
            return redirect()->back()->with('success', 'Slider has been deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
}
