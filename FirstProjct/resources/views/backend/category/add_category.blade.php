@extends('admin')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">Category List</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($categories as $index=>$category)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $category->category_name }}</td>

                            <td><img src="{{ asset('uploads/category') }}/{{ $category->category_image }}" alt=""></td>

                            <td>{{ $category->slug }}</td>
                            <td class="text-center">
                                <a href="{{ route('delete.category', $category->id) }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('edit.category', $category->id) }}" class="btn btn-info"><i class="fa-solid fa-pen"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3>Add New Category</h3>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
              <form action="{{ route('store.category') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label ">Category Name</label>
                    <input type="text" name="category_name" class="form-control">
                    @error('category_name')
                        <span class="text-danger">{{ $message }}</span>=
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label ">Category Image</label>
                    <input type="file" name="category_image" class="form-control" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                    @error('category_image')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="my-5">
                    <img src="{{ asset('uploads/category') }}" id="blah" alt="" width="100">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary form-control">Add Category</button>
                </div>
              </form>
            </div>
        </div>
    </div>
</div>
@endsection
