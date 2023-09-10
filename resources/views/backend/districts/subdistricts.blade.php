{{-- 
@foreach ($districts as $district)
<tr>
    <td>{{$loop->index+1}}</td>
    <td>{{$district->name}}</td>
    <td>
        @foreach ($district->users as $user)
            <span class="badge badge-info mr-1">
                {{ $user->name }}
            </span>
        @endforeach
    </td>
</tr>
@endforeach
 --}}

@extends('backend.layouts.app')
@section('content')
    <div class="main-card mb-3 card">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-actions">
                    
                </div>    
            </div>
        </div>
        <div class="card-body">
            <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>District</th>
                    <th>ASM List</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($subDistricts as $subDistrict)
                    <tr>
                        <td>{{$loop->index+1}}</td>
                        <td>{{$subDistrict->name}}</td>
                        
                        <th>
                            @foreach ($subDistrict->users as $user)
                                {{ $user->name }}
                            @endforeach
                            {{-- @if ($subDistrict->users->isEmpty())
                                <span class="badge badge-danger">No Users</span>
                            @endif --}}
                        </th>
                        {{-- @empty
                        <tr>
                            <td colspan="4" class="text-center">No Data Dound</td>
                        </tr> --}}
                    </tr>
                    
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
