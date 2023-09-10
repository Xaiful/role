@extends('backend.layouts.app')
@section('content')
<div class="container">
    @foreach($pivotDatas as $pivotData)
    <div class="card mb-3">
        <div class="card-header">
            {{-- Warehouse: {{ $warehouse->name }} --}}
        </div>
        <div class="card-body">
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Quantity</th>
                            <th>Damage</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $pivotData->id }}</td>
                            <td>{{ $pivotData->quantity }}</td>
                            <td>{{ $pivotData->damage }}</td>
                            <td>{{ $pivotData->status }}</td>
                            <td>{{ $pivotData->created_at }}</td>
                        </tr>
                        
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
