@extends('backend.layouts.app')
@section('content')
<div class="main-card mb-3 card">
    <div class="card-body">
        <h5 class="card-title">Create New Units</h5>
        <form id="unitForm" class="col-md-10 mx-auto" method="post" action="{{route('areas.store')}}">
            @csrf
            <div class="form-group">
                <label for="firstname">Name</label>
                <div>
                    <input type="text" class="form-control" name="name" placeholder="Enter Your category" />
                </div>
            </div>            
            <div class="form-group">
                <label for="firstname">Start </label>
                <div>
                    <input type="text" class="form-control" name="start" placeholder="Enter Your category" />
                </div>
            </div>
            <div class="form-group">
                <label for="firstname">End</label>
                <div>
                    <input type="text" class="form-control" name="end" placeholder="Enter Your category" />
                </div>
            </div>
            <div class="mb-3 form-group">
                <select id="sub_district_id" class="form-control @error('sub_district_id') is-invalid @enderror" name="sub_district_id" required>
                    <option value="">Select Sub District</option>
                    @foreach($subDistricts as $subDistrict)
                        <option value="{{ $subDistrict->id }}" {{ old('devision') == $subDistrict->id ? 'selected' : '' }}>{{ $subDistrict->name }}</option>
                    @endforeach
                </select>
                
                @error('devision_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
@push('js')
<script>
    $("#checkAll").click(function(){
             if($(this).is(':checked')){
                 // check all the checkbox
                 $('input[type=checkbox]').prop('checked', true);
             }else{
                 // un check all the checkbox
                 $('input[type=checkbox]').prop('checked', false);
             }
         });
</script>
@endpush