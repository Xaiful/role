@extends('backend.layouts.app')
@section('content')
    <div class="main-card mb-3 card">
        <div class="app-page-title">
            <a class="btn btn-lg btn-transition btn btn-outline-success" href="{{route('rawmaterialshops.create')}}">
                Create 
            </a>
        <div class="card-body">
            <table id="example" class="table table-hover table-striped table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($rawMaterialsShops as $rawMaterialsShop)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$rawMaterialsShop->shopeName}}</td>
                        <td>{{$rawMaterialsShop->address}}</td>
                        <td>{{$rawMaterialsShop->phone}}</td>
                        <td>
                            <a class="mb-2 mr-2 btn-transition btn btn-outline-success" href="{{route('rawmaterialshops.edit',$rawMaterialsShop->id)}}">Edit</a>
                            <a class="delete-row mb-2 mr-2 btn-transition btn btn-outline-danger" href="{{route('rawmaterialshops.destroy',$rawMaterialsShop->id)}}">Delete</a>
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