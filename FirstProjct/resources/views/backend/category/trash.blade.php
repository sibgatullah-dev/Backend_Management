@extends('admin')
@section('content')



<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header"><h3>Trashed Categories</h3></div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($trashed as $index=>$trash)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $trash->category_name }}</td>

                            <td><img src="{{ asset('uploads/category') }}/{{ $trash->category_image }}" alt=""></td>

                            <td>{{ $trash->slug }}</td>
                            <td class="text-center">
                                <a href="{{ route('pdelete.category', $trash->id) }}" class="btn trash-btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('restore.category', $trash->id) }}" class="btn btn-success"><i class="fa-solid fa-recycle"></i></a>
                            </td>

                        </tr>
                    @endforeach
                </table>
                <style>
                    .trash-btn:hover {
                        background-color: rgb(158, 12, 12);
                        color: white;
                        transition: 0.5s;
                        border-color: rgb(158, 12, 12);
                    }
                </style>
            </div>
        </div>
    </div>
</div>

@endsection
