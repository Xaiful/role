@extends('backend.layouts.app')
@section('content')
<div class="container">
    {{-- @foreach($warehouses as $warehouse) --}}
    <div class="card mb-3">
        <div class="card-header">
            {{ $warehouse->name }}
            @foreach($pivotDatas as $pivotData)
                
            @endforeach
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Damage</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($warehouse->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>
                            {{ $product->pivot->quantity }}
                        </td>
                        <td>
                            {{ $product->pivot->damage }}
                        </td>
                        <td>
                            {{ $product->pivot->status }}
                        </td>
                        <td>{{ $product->pivot->created_at }}</td>
                        <td>
                            {{-- <a href="{{ route('warehouse.editProductQuantity', ['id' => $pivotData->id]) }}" class="btn btn-primary">Edit</a> --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- @endforeach --}}
</div>
@endsection



{{-- 
@foreach($warehouse->products as $product)
    <tr>
        <td>{{ $product->name }}</td>
        @php
            $pivotData = $product->pivot;
        @endphp
        <form action="{{ route('products.updateQuantity', ['warehouse' => $warehouse->id, 'product' => $product->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <td><input type="number" class="form-control" name="quantity" value="{{ old('quantity', $pivotData->quantity) }}"></td>
            <td><input type="number" class="form-control" name="damage" value="{{ old('damage', $pivotData->damage) }}"></td>
            <td>{{ $pivotData->status }}</td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>    
        </form>
    </tr>
@endforeach --}}