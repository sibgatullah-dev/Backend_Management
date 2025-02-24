@extends('admin')

@section('content')

<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Edit Category</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
              <form action="{{ route('update.category', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label ">Category Name</label>
                    <input type="text" name="category_name" class="form-control" value="{{ $category->category_name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label ">Category Image</label>
                    <input type="file" name="category_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])" >

                </div>
                <div class="my-4">
                    <img width="150px" src="{{ asset('uploads/category') }}/{{ $category->category_image }}"  id="blah" alt="" width="100">
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Update Category</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>

@endsection
