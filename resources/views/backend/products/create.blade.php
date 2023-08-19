@extends('backend.layouts.app')
@section('content')
    <div class="main-card mb-3 card">
        <form method="POST" action="{{ route('products.store') }}">
            @csrf
            <label for="name">Product Name:</label>
            <input type="text" name="name" required>
            <br>
            
            <label for="description">Description:</label>
            <textarea name="description"></textarea>
            <br>
            
            <label>Raw Materials:</label>
            @foreach ($rawmaterials as $rawmaterial)
                <div>
                    <input type="checkbox" name="raw_material_ids[]" value="{{ $rawmaterial->id }}">
                    {{ $rawmaterial->name }}
                    Quantity: <input type="number" name="quantity_{{ $rawmaterial->id }}">
                </div>
            @endforeach
            <br>
            
            <button type="submit">Create Product</button>
        </form>
        
    </div>
@endsection    
