@extends('backend.layouts.app')
@section('content')
    <div class="main-card mb-3 card">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-actions">
                    <a class="btn btn-lg btn-transition btn btn-outline-success" href="{{route('subdistricts.create')}}">
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
                    
                </tr>
                </thead>
                <tbody>
                    @forelse ($subDistricts as $subDistrict)
                    <tr>
                        <td>{{$subDistrict->iteration}}</td>
                        <td>{{$subDistrict->name}}</td>
                        <td>
                            <a class="mb-2 mr-2 btn-transition btn btn-outline-success" href="{{route('subdistricts.edit',$district->id)}}">Edit</a>
                            <a class="delete-row mb-2 mr-2 btn-transition btn btn-outline-danger" href="{{route('subdistricts.destroy',$district->id)}}">Delete</a>
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