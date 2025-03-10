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
                    @forelse ($trashed as $index=>$trash)
                        <tr>
                            <td>{{ $index+1 }}</td>
                            <td>{{ $trash->category_name }}</td>

                            <td><img src="{{ asset('uploads/category') }}/{{ $trash->category_image }}" alt=""></td>

                            <td>{{ $trash->slug }}</td>
                            <td class="text-center">
                                <a data-link="{{ route('pdelete.category', $trash->id) }}" class="btn del btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('restore.category', $trash->id) }}" class="btn btn-success "><i class="fa-solid fa-recycle"></i></a>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">No Trash Found</td>
                        </tr>
                    @endforelse
                </table>
                <style>
                    .del:hover {
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



 @section('script')
     <script>
         let del = document.querySelectorAll('.del')
         let delArr = Array.from(del)

         delArr.map(item=>{
             item.addEventListener('click', function(e){


                 let link = e.target.dataset.link;
                 Swal.fire({
                     title: "Are you sure?",
                     text: "You won't be able to revert this!",
                     icon: "warning",
                     showCancelButton: true,
                     confirmButtonColor: "#3085d6",
                     cancelButtonColor: "#d33",
                     confirmButtonText: "Yes, delete it!"
                 }).then((result) => {
                     if (result.isConfirmed) {
                         // Perform the delete action using the link
                         let link = this.dataset.link;

                         window.location.href = link;

                     }
                 });
             })
         })
    </script>

@if(session('del_success'))
    <script>
        Swal.fire({
            title: "Deleted!",
            text: "{{ session('sel_success') }}",
            icon: "success"
        });
    </script>
@endif
 @endsection




{{--  --}}


