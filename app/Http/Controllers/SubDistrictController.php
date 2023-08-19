<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\SubDistrict;
use App\Http\Requests\StoreSubDistrictRequest;
use App\Http\Requests\UpdateSubDistrictRequest;

class SubDistrictController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:subdistricts-list', ['only' => ['index','show']]);
         $this->middleware('permission:subdistricts-create', ['only' => ['create','store']]);
         $this->middleware('permission:subdistricts-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:subdistricts-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['subDistricts'] = SubDistrict::get();
        return view('backend.subdistricts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['districts'] = District::get();
        return view('backend.subdistricts.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubDistrictRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubDistrictRequest $request)
    {
        $subDistrict = SubDistrict::create([
            'name' => $request->input('name'),
            'district_id' => $request->input('district_id')
        ]);
    //dd($subcategory);
        if(!empty($subDistrict)){
            return redirect()->route('subdistricts.index')->with('success' ,'Your SubDistrict has been added');
            }
            return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function show(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function edit(SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubDistrictRequest  $request
     * @param  \App\Models\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubDistrictRequest $request, SubDistrict $subDistrict)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubDistrict  $subDistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubDistrict $subDistrict)
    {
        //
    }
}
