<?php

namespace App\Http\Controllers;

use App\Http\Requests\Reports\ReportCreateRequest;
use App\Http\Requests\Reports\ReportUpdateRequest;
use App\Models\Report;
use App\Models\ReportCategory;
use Illuminate\Http\Request;
use App\Traits\UploadImage;

class ReportController extends Controller
{
    use UploadImage;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            if ($request->has('show')) {
                $reports=Report::paginate($request->show);
                $show=$request->show;
            }elseif($request->has('query')) {

                $query = preg_replace('/[0-9\@\.\;\" "]+/','', $request->get('query'));
                $reports = Report::where('title', 'LIKE', "%{$query}%")
                ->Orwhere('status', 'LIKE', "%{$query}%")
                ->paginate(10);

            } else {
                $reports = Report::paginate(10);
            }
            return view('admin.report.index')
                        ->with('data',$reports)
                        ->with('show',@$show);
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
        $categories = ReportCategory::get();
        return view('admin.report.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReportCreateRequest $request)
    {
       try{
            $data = $request->validated();

            if (!empty($data['image'])) {
                $image = $this->uploadImage($data['image'],'reports');
                $data['image'] = $image['path'];
            }
            if (!empty($data['file'])) {
                $file = $this->uploadImage($data['file'],'reports');
                $data['file'] = $file['path'];
            }

            $report = Report::create($data);
            return redirect()->back()->with('success', 'Report has been created successfully created');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $report = Report::find($id);
            if(!$report) {
                throw new \Exception('Report could not be found on server');
            }
            $categories = ReportCategory::get();
            return view('admin.report.edit')
                ->with('detail', $report)
                ->with('categories', $categories);
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(ReportUpdateRequest $request, $id)
    {
        try{
            $report = Report::find($id);
            if(!$report) {
                throw new \Exception('Report could not be found on server');
            }
            $data = $request->validated();

                if (!empty($data['image'])) {
                    $image = $this->uploadImage($data['image'],'reports');
                    $data['image'] = $image['path'];

                    if ($report->image) {
                        unlink(public_path($report->image));
                    }
                }
                if (!empty($data['file'])) {
                    $file = $this->uploadImage($data['file'],'reports');
                    $data['file'] = $file['path'];

                    if ($report->file) {
                        unlink(public_path($report->file));
                    }
                }
            $update = $report->update($data);
            return redirect()->back()->with('success', 'Report has been updated successfully created');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $report = Report::find($id);
            if(!$report) {
                throw new \Exception('Report could not be found on server');
            }
            if ($report->image) {
                unlink(public_path($report->image));
            }
            if ($report->file) {
                unlink(public_path($report->file));
            }
            $report->delete();
            return redirect()->back()->with('success', 'Report has been deleted successfully created');
        } catch(\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
