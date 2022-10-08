<?php

namespace App\Http\Controllers\Admin;

use App\Models\Application;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Image;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // return Application::all();
        if ($request->ajax()) {
            if ($request->name != null) {
                    return datatables(Application::query()->where('name','like', $request->name)->with('divisions','districts','upazilas'))->toJson();
            }
            if ($request->email != null) {
                    return datatables(Application::query()->where('email','like', $request->email)->with('divisions','districts','upazilas'))->toJson();
            }

            if ($request->division != null) {
                    return datatables(Application::query()->where('division', $request->division)->with('divisions','districts','upazilas'))->toJson();
            }
            if ($request->district != null) {
                    return datatables(Application::query()->where('district', $request->district)->with('divisions','districts','upazilas'))->toJson();
            }
            if ($request->upazila != null) {
                    return datatables(Application::query()->where('upazila', $request->upazila)->with('divisions','districts','upazilas'))->toJson();
            }
            if ($request->division != null && $request->district != null && $request->upazila != null) {
                return datatables(Application::query()->where('division', $request->division)->orWhere('district', $request->district)->orWhere('upazila', $request->upazila)->with('divisions','districts','upazilas'))->toJson();
        }
            return datatables(Application::query()->with('divisions','districts','upazilas'))->toJson();
        }


        return view('application.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
     $application = Application::with('divisions','districts','upazilas','educations')->where('id',$id)->first();

        //  foreach($application as $app){
        //    $exam_name =(int) json_decode($app->exam_name);
        //  }

        return view('application.show', compact('application'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $application = Application::with('divisions','districts','upazilas','educations')->where('id',$id)->first();

        // dd($application);
        return view('application.edit', compact('application'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {


    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'phone_no' => 'required|min:11|numeric',
        'division' => 'required',
        'district' => 'required',
        'upazila' => 'required',
        'address' => 'required',
        'language' => 'required',
        'images' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'cv' => 'mimes:pdf',
        'exam_name.*' => 'required',
        'university.*' => 'nullable',
        'boards.*' => 'nullable',
        'results.*' => 'nullable',
    ]);


        // dd($request->all());


        try {

            $application = DB::transaction(function () use ($request,$validated, $application) {



                if($request->hasFile('images')){
                    \App\Lib\Image::delete($application->images, 'images');
                    $images = Image::store('images','upload/images');
                }
                else{
                    $images = $application->images;
                }
                if($request->hasFile('cv')){
                    \App\Lib\Image::delete($application->cv, 'cv');
                    $cv = Image::store('cv','upload/cv');
                }
                else{
                    $cv = $application->cv;
                }


                $application->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone_no,
                    'division' => $request->  division,
                    'district' => $request->district,
                    'upazila' => $request->upazila,
                    'address' => $request->address,
                    'language' => json_encode($request->language),
                    'images' => $images,
                    'cv' => $cv,
                ]);

        $educations = [];

        for ($i = 0; $i < count($request->exam_name); $i++) {
            $educations[] = [
                'exam_name' => $validated['exam_name'][$i],
                'university' => $validated['university'][$i],
                'boards' => $validated['boards'][$i],
                'results' => $validated['results'][$i],
            ];
        }
        if(count($educations)) {
            $application->educations()->delete();
            $application->educations()->createMany($educations);
        }
        // dd($educations);
        // Education::where('application_id', $application->id)->update($educations);



                return $application;
            });


            return response()->report($application, 'application Updated Successfully');
        } catch (\Exception $ex) {
			//return $ex;
            return response()->error();
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
        //
    }
}
