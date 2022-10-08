<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Lib\Image;
use Illuminate\Http\Response;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('frontend.form');
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
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone_no' => 'required|min:11|numeric',
            'division' => 'required',
            'district' => 'required',
            'upazila' => 'required',
            'address' => 'required',
            'language' => 'required',
            'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'cv' => 'required|mimes:pdf',
            'training' => 'required',
            'exam_name.*' => 'required',
            'university.*' => 'nullable',
            'boards.*' => 'nullable',
            'results.*' => 'nullable',
            'training_name.*' => 'nullable',
            'details.*' => 'nullable',
        ]);


                if($request->hasFile('images')){
                    $images = Image::store('images','upload/images');
                }
                if($request->hasFile('cv')){
                    $cv = Image::store('cv','upload/cv');
                }

                    $data = new Application;
                    $data->name = $request->name;
                    $data->email = $request->email;
                    $data->phone = $request->phone_no;
                    $data->phone = $request->phone_no;
                    $data->division = $request->division;
                    $data->district = $request->district;
                    $data->upazila = $request->upazila;
                    $data->address = $request->address;
                    $data->language = json_encode($request->language);
                    $data->images = $images;
                    $data->cv = $cv;
                    $data->training = $request->training;
                    $data->training_name =json_encode( $request->training_name);
                    $data->training_details =json_encode($request->details);

                    if($data->save()){
                        $educations = [];

                    for ($i = 0; $i < count($request->exam_name); $i++) {
                        $educations[] = [
                            'application_id' => $data->id,
                            'exam_name' => $validated['exam_name'][$i],
                            'university' => $validated['university'][$i],
                            'boards' => $validated['boards'][$i],
                            'results' => $validated['results'][$i],
                        ];
                    }

                    // var_dump($educations);exit;

                    Education::insert($educations);
                        $data['success'] = 1;
                        $data['message'] = 'Form Uploaded Successfully!';
                    }

                    return response()->json($data);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd($request->all());
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


    public function getDistrictList(Request $request){
        $divisions = DB::table("districts")
        ->where("division_id",$request->division_id)
        ->pluck("name","id");
        return response()->json($divisions);
    }

    public function getUpazilaList(Request $request){
        $districts = DB::table("upazilas")
        ->where("district_id",$request->district_id)
        ->pluck("name","id");
        return response()->json($districts);
    }
}
