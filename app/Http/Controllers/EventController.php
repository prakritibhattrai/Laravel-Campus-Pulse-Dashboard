<?php

namespace App\Http\Controllers;

use App\Http\Requests\Events\EventCreateRequest;
use App\Http\Requests\Events\EventUpdateRequest;
use App\Models\Event;
use Illuminate\Http\Request;
use App\Traits\UploadImage;
use Exception;
use Illuminate\Support\Str;

class EventController extends Controller
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
                $events = Event::paginate($request->show);
                $show = $request->show;
            }elseif($request->has('query')){
                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $events = Event::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('veneu', 'LIKE', "%{$query}%")
                ->paginate(10);
            }else {
                $events = Event::paginate(10);
            }
            return view('admin.event.index')
                ->with('data', $events)
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
        return view('admin.event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCreateRequest $request)
    {
        try{
            $data = $request->validated();

            if(empty($data['slug'])) {
                $data['slug'] = Str::slug($data['title'], '-');
            }

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'events');
                $data['image'] = $image['path'];
            }
            Event::create($data);
            return redirect()->back()->with('success','Event has been created successfully');

        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        return view('admin.event.edit')
            ->with('detail', $event);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request, $id)
    {
        try{
            $event = Event::find($id);
            if(!$event) {
                throw new Exception('Event could not be found on server');
            }
            $data = $request->validated();

            if(empty($data['slug'])){
            $data['slug'] = Str::slug($data['title'], '-');
            }
                if (!empty($data['image'])) {
                    $image = $this->uploadImage($data['image'],'events');
                    $data['image'] = $image['path'];

                    if ($event->image) {
                        unlink(public_path($event->image));
                    }
                }

            $update = $event->update($data);
            if ($update) {
                return redirect()->back()->with('success', 'Event has been updated successfully');
            }
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $event = Event::find($id);
            if(!$event) {
                throw new Exception('Event could not be found on server');
            }
            if ($event->image) {
                unlink(public_path($event->image));
            }
            $event->delete();
            return redirect()->back()->with('success', 'Event has been deleted successfully');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
