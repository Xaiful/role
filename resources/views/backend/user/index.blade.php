@extends('backend.layouts.app')
@section('content')
    <div class="main-card mb-3 card">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-actions">
                    <a class="btn btn-lg btn-transition btn btn-outline-success" href="{{route('users.create')}}">
                        Create 
                    </a>
                </div>    
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$user->name}}</td>
                        {{-- <td>{{$user->email}}</td> --}}
                        <td>
                            @foreach ($user->roles as $role)
                            <span class="badge badge-info mr-1">
                                {{ $role->name }}
                            </span>
                        @endforeach
                        </td>
                        <td>{{$user->email}}</td>
                        <td>
                            @can('user-edit')
                            <a class="mb-2 mr-2 btn-transition btn btn-outline-success" href="{{route('users.edit',$user->id)}}">Edit</a>
                            @endcan
                            @can('user-delete')
                            <a class="delete-row mb-2 mr-2 btn-transition btn btn-outline-danger" href="{{route('users.destroy',$user->id)}}">Delete</a>
                            @endcan
                        </td>
                    </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No Data Dound</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection