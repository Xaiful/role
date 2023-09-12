<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use App\Models\Devision;
use App\Models\District;
use App\Models\RolesDevision;
use App\Models\SubDistrict;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:user-list', ['only' => ['index','show']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['devisions'] = Devision::all();
        $data['districts'] = District::all();
        $data['subDistricts'] = SubDistrict::all();
        $data['areas'] = Area::pluck('name','id');
        // $data['users'] = User::all();
        $data['users'] = User::get();

        return view('backend.user.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['devisions'] = Devision::pluck('name','id');
        $data['districts'] = District::pluck('name','id');
        $data['subDistricts'] = SubDistrict::pluck('name','id');
        $data['areas'] = Area::pluck('name','id');
        $data['roles'] = Role::all();
        $data['permissions'] = Permission::all();
        return view('backend.user.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', 'min:8'],
        'role' => ['required'], // Add validation rule for role
    ]);

    $user = User::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'password' => Hash::make($validatedData['password']),
    ]);
    
   
    $role = Role::findByName($validatedData['role']);
    $user->assignRole($role);

    if ($role->name === 'RSM') {
        $user->devisions()->attach($request->input('devision_id'));
    } elseif ($role->name === 'ASM') {
        $user->districts()->attach($request->input('district_id'));
    } elseif ($role->name === 'SPO') {
        $user->subDistricts()->attach($request->input('sub_district_id'));
    } elseif ($role->name === 'ASPO') {
        $user->areas()->attach($request->input('area_id'));
    }
    // $devisionId = $request->input('devision_id');
    // if ($request->has('devision_id')) {
    //     $devision = Devision::find($request->input('devision_id'));
    //     if ($devision) {
    //         $user->devisions()->attach($devision->id);
    //     }
    // } elseif ($request->has('new_devision')) {
    //     $newDevision = Devision::create([
    //         'name' => $request->new_devision,
    //     ]);
    //     if ($newDevision) {
    //         $user->devisions()->attach($newDevision->id);
    //     }
    // }
    
    // Associate geographic areas based on the selected role
    // if ($role->name === 'NSM') {
    //     $devision = Devision::find($request->input('devision_id'));
    //     $user->devisions()->attach($devision);
    // } elseif ($role->name === 'RSM') {
    //     $district = District::find($request->input('district_id'));
    //     $user->districts()->attach($district);
    // } elseif ($role->name === 'ASM') {
    //     $subDistrict = SubDistrict::find($request->input('sub_district_id'));
    //     $user->subDistricts()->attach($subDistrict);
    // }
    // dd($request);

    // Redirect to the user index page
    return redirect()->route('users.index')->with('success', 'User created successfully.');
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
        $data['user'] = User::where('id',$id)->first();
        $data['roles'] = Role::all();
        $data['devisions'] = Devision::get();
        $data['rolesDevision'] = RolesDevision::select('*')->where('user_id',$id)->first();
        $data['districts'] = District::pluck('name','id');
        $data['subDistricts'] = SubDistrict::pluck('name','id');
        $data['areas'] = Area::pluck('name','id');
        $data['permissions'] = Permission::all();
        return view('backend.user.edit',$data);
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
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$id
        ]);

        $rolesDevision = RolesDevision::where('user_id',$id)->first();
        $rolesDevision->devision_id = $request->devision_id;
        $rolesDevision->update();

        $user = User::where('id',$id)->first();
        $user->name = $request->name;
        $user->email = $request->email;

        if($user->update()){
            if ($request->roles) {
                $user->roles()->detach();
                $user->assignRole($request->roles);
            }
            return redirect()->route("users.index");
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::where('id',$id)->delete();
        if(!empty($user)){
            return back();
        }
        return back();
    }
}
