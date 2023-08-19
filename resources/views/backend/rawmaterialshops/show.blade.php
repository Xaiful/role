@extends('backend.layouts.app') <!-- Assuming you have a layout template -->

@section('content')
<h1>{{ $rawMaterialsShop->shopeName }}</h1>
<p>Address: {{ $rawMaterialsShop->address }}</p>
<p>Phone: {{ $rawMaterialsShop->phone }}</p>

<h2>Raw Materials from this Shop:</h2>
<ul>
    @foreach ($rawMaterialsShop->rawmaterials as $rawmaterial)
        <li>{{ $rawmaterial->name }} - Quantity: {{ $rawmaterial->quantity }}</li>
    @endforeach
</ul>
@endsection
