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
            <form action="{{ route('rawmaterials.saveAll') }}" method="POST" id="rawmaterialForm" enctype="multipart/form-data">
                @csrf
                <h4>Add Raw Material</h4>
                <br>
                <div class="row">
                    <div class="col-md-2 form-group">
                        <select id="subcategory_id" class="form-control @error('rawmaterials.0.subcategory_id') is-invalid @enderror" name="rawmaterials[0][subcategory_id]" required>
                            <option value="">Select subCategory</option>
                                @foreach($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}" {{ old('rawmaterials.0.subcategory_id') == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                @endforeach
                        </select>
                        @error('rawmaterials.0.subcategory_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <input name="rawmaterials[0][name]" type="text" class="form-control" placeholder="Raw Material Name" required>
                        <p style="color: red">{{ $errors->first('rawmaterials.0.name') }}</p>
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="mb-3 form-group">
                            <input name="rawmaterials[0][quantity]" type="number" class="form-control" placeholder="Quantity" required>
                            <p style="color: red">{{ $errors->first('rawmaterials.0.quantity') }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <select id="unit_id" class="form-control @error('rawmaterials.0.subcategory_id') is-invalid @enderror" name="rawmaterials[0][unit_id]" required>
                            <option value="">Select Unit</option>
                                @foreach($units as $unit)
                                    <option value="{{ $unit->id }}" {{ old('rawmaterials.0.subcategory_id') == $unit->id ? 'selected' : '' }}>{{ $unit->name }}</option>
                                @endforeach
                        </select>
                        @error('rawmaterials.0.subcategory_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="mb-3 form-group">
                            <input name="rawmaterials[0][memo_no]" type="number" class="form-control" placeholder="Memo No" required>
                            <p style="color: red">{{ $errors->first('rawmaterials.0.memo_no') }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="form-group">
                            <input type="number" step="0.01" class="form-control" id="unit_price" name="rawmaterials[0][unit_price]" placeholder="Unit per taka" required>
                            <p style="color: red">{{ $errors->first('rawmaterials.0.unit_price') }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <div class="form-group">
                            <input name="rawmaterials[0][shopeName]" type="text" class="form-control" placeholder="Enter Your Shop" required>
                            <p style="color: red">{{ $errors->first('rawmaterials.rawmaterialShops.0.shopeName') }}</p>
                        </div>
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control" name="rawmaterials[0][address]" placeholder="Enter Your Shop Address" required />
                        <p style="color: red">{{ $errors->first('rawmaterials.rawmaterialShops.0.address') }}</p>
                    </div>
                    <div class="col-md-2 form-group">
                        <input type="text" class="form-control" name="rawmaterials[0][phone]" placeholder="Enter Your Shop Phone" required />
                        <p style="color: red">{{ $errors->first('rawmaterials.rawmaterialShops.0.phone') }}</p>
                    </div>
                </div>
                <br>
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

<script>
    var formIndex = 0; // Variable to track the index of the cloned forms

    // Function to clone the form
    function cloneForm() {
        var clonedForm = $('#rawmaterialForm').find('.row:first').clone(); // Clone the first form row

        formIndex++; // Increment the form index

        // Update the name attributes of the input fields in the cloned form
        clonedForm.find('[name^="rawmaterials[0]"]').each(function () {
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
        $('#rawmaterialForm').submit(); // Submit the main form
    }
</script>
@endsection



