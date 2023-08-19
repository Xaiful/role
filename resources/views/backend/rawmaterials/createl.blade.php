@extends('backend.layouts.app')

@section('content')
<div class="main-card mb-3 card">
    <div class="card">
        <div class="card-header">
            <h4>
                <a href="{{ route('rawmaterials.index') }}" class="btn btn-sm btn-primary">List</a>
            </h4>
        </div>
        <div class="card-body">
            <form action="{{ route('rawmaterials.saveAll') }}" method="POST" id="rawmaterialForm">
                @csrf
                <h4>Add Raw Material</h4>
                <br>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <select id="subcategory_id" class="form-control @error('subcategory_id') is-invalid @enderror" name="subcategory_id" required>
                            <option value="">Select Subcategory</option>
                            @foreach($subcategories as $subcategory)
                                <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                            @endforeach
                        </select>
                        @error('subcategory_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Raw Material Name" required>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="mb-3 form-group">
                            <input name="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity" required>
                            @error('quantity')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="unit_id" class="form-control @error('unit_id') is-invalid @enderror" name="unit_id" required>
                            <option value="">Select Unit</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                        @error('unit_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="mb-3 form-group">
                            <input name="memo_no" type="number" class="form-control @error('memo_no') is-invalid @enderror" placeholder="Memo No" required>
                            @error('memo_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control @error('unit_price') is-invalid @enderror" id="unit_price" name="unit_price" placeholder="Unit per Taka" required>
                            @error('unit_price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="shopeName" placeholder="Enter Your Shop" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="address" placeholder="Enter Your Shop Address" required />
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="text" class="form-control" name="phone" placeholder="Enter Your Shop Phone" required />
                    </div>
                </div>

               

                <div id="clonedForms">

                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-sm btn-success" onclick="cloneForm()">+</button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeForm()">-</button>
                </div>
                <button type="button" class="btn btn-sm btn-primary" onclick="saveAllForms()">Save All</button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    var formIndex = 0; // Variable to track the index of the cloned forms

    // Function to clone the form
    function cloneForm() {
        var clonedForm = $('#medicineForm').find('.row:first').clone(); // Clone the first form row

        formIndex++; // Increment the form index

        // Update the name attributes of the input fields in the cloned form
        clonedForm.find('[name^="medicines[0]"]').each(function () {
            var originalName = $(this).attr('name');
            var updatedName = originalName.replace('[0]', '[' + formIndex + ']');
            $(this).attr('name', updatedName);
        });

        clonedForm.find('input').val(''); // Clear the input values in the cloned form
        clonedForm.find('.invalid-feedback').remove(); // Remove any error messages in the cloned form

        clonedForm.appendTo('#clonedForms'); // Append the cloned form to the container

        // Show the remove button for the cloned form
        clonedForm.find('.btn-danger').show();
    }

    // Function to remove the form
    function removeForm() {
        var clonedFormsCount = $('#clonedForms .row').length;

        if (clonedFormsCount > 0) {
            $('#clonedForms .row:last').remove(); // Remove the last cloned form row
        }

        if (clonedFormsCount === 1) {
            $('#clonedForms .btn-danger'); // Hide the remove button if there is only one form
        }
    }

    // Function to save all the forms
    function saveAllForms() {
        $('#medicineForm').submit(); // Submit the main form
    }
</script>
@endpush
