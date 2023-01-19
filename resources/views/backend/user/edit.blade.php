@extends('backend.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Edit User</h5>
        <form id="signupForm" class="col-md-10 mx-auto" method="post" action="{{route('users.update',$user->id)}}">
            @csrf
            @method("PUT")
            <div class="form-group">
                <label for="firstname">Name</label>
                <div>
                    <input type="text" class="form-control" id="firstname" name="name" placeholder="Enter Your Name" value="{{$user->name}}" />
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <div>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email" value="{{$user->email}}" />
                </div>
            </div>

            <div class="form-group">
                <label for="exampleCustomSelect">Select Role</label>
                <select multiple="" type="select" id="exampleCustomMutlipleSelect"
                class="custom-select"  name="roles[]">
                    <option value="">Select</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
        
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection