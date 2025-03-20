@extends('admin')
@section('content')
<div class="roe">
    <div class="col-lg-8 m-auto">
        <div class="card mt-3">
            <div class="card-header bg-primary text-white">
                <h3>Edit SubCategory</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
              <form action="{{ route('update.subcategory', $subcategory->id) }}" method="POST" >
                @csrf
                <div class="mb-3">
                    <label class="form-label ">Category</label>
                   <select name="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $subcategory->category_id == $category->id?'selected':'' }}>{{ $category->category_name }}</option>
                    @endforeach

                   </select>
                </div>

                <div class="mb-3">
                    <label class="form-label ">Sub-Category Name</label>
                    <input type="text" name="subcategory_name" class="form-control" value="{{ $subcategory->subcategory_name }}" >
                    @error('subcategory_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-5">
                    <img src="{{ asset('uploads/category') }}" id="subcategory_preview" alt="" width="100">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Update Sub-Category</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>

@endsection
