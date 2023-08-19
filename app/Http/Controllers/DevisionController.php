<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDevisionRequest;
use App\Http\Requests\UpdateDevisionRequest;
use App\Models\Devision;

class DevisionController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:devisions-list', ['only' => ['index','show']]);
         $this->middleware('permission:devisions-create', ['only' => ['create','store']]);
         $this->middleware('permission:devisions-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:devisions-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['devisions'] = Devision::all();
        return view('backend.devisions.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.devisions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDevisionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDevisionRequest $request)
    {
        $devision = Devision::create([
            'name'=>$request->name,
        ]);
        if(!empty($devision)){
            return redirect()->route('devisions.index')->with('success' ,'Your Devisions has been added');
            }
            return redirect()->back()->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function show(Devision $devision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function edit(Devision $devision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDevisionRequest  $request
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDevisionRequest $request, Devision $devision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devision  $devision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devision $devision)
    {
        //
    }
}
