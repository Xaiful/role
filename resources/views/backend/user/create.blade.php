@extends('backend.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Create New User</h5>
        <form id="signupForm" class="col-md-10 mx-auto" method="post" action="{{route('users.store')}}">
            @csrf
            <div class="form-group">
                <label for="firstname">Name</label>
                <div>
                    <input type="text" class="form-control" id="firstname" name="name" placeholder="Enter Your Name" />
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <div>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter Your Email" />
                </div>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter Your Password" />
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm password</label>
                <div>
                    <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Enter Confirm password" />
                </div>
            </div>

            <div class="form-group">
                <label for="exampleCustomSelect">Select Role</label>
                <select type="select" id="exampleCustomSelect" name="role" class="custom-select">
                    <option value="">Select</option>
                    @forelse ($roles as $role)
                        <option>{{$role->name}}</option>
                    @empty
                    <option>No Role Found</option>
                    @endforelse
                </select>
            </div>
            {{-- <div class="form-group">
                <label for="firstname">Permissions</label>
                <div>
                @forelse($permissions as $permission)
                <div class="position-relative form-check">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="permissions[]" value="{{$permission->id}}"> {{$permission->name}}
                    </label>
                </div>
                @empty
                    
                @endforelse
                </div>
            </div> --}}
            
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection