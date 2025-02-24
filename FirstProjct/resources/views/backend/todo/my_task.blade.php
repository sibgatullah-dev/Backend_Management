@extends('admin')
@section( 'content')
<div class="col-lg-8">
    <div class="card">
        <div class="card-header"><h3>My Task List</h3></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>SL</th>
                    <th>Task</th>
                    <th>Deadline</th>

                    <th>Assigned by</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                @foreach($tasks as $task)
                    <tr>

                            <td>{{ $task->id }}</td>
                            <td>{{ $task->task_name }}</td>
                            <td>
                                {{-- {{ $diff = Carbon\Carbon::parse($task->date)->diffForHumans() }} --}}
                                {{ $diff = Carbon\Carbon::parse($task->date)->diffForHumans(Carbon\Carbon::now()) }}
                            </td>

                            <td>{{ $task->rel_to_user->name }}</td>
                            <td class="text-center fs-4">
                                <span class="badge badge-{{ $task->status==0?'secondary':'success' }}">{{ $task->status==0?'Undone':'Done' }}</span>
                            </td>

                        <td class="text-center">
                            {{--  --}}
                            <a href="" class="btn btn-success done_btn" data-id="{{ $task->id }}" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-check"></i></a>

                            <a href="{{ route('todo.delete', $task->id) }}" class="btn btn-danger trash_btn"><i class="fa-solid fa-trash-can"></i></a>

                            <style>
                                .trash_btn{
                                    border-color: transparent;
                                }
                                .trash_btn:hover {
                                    background-color: rgb(158, 12, 12);
                                    color: white;
                                    transition: 0.5s;
                                    border-color: rgb(158, 12, 12);

                                }
                                .done_btn:hover {
                                    background-color: rgb(9, 126, 18);
                                    color: white;
                                    transition: 0.5s;
                                    border-color: rgb(9, 126, 18);

                                }
                            </style>
                        </td>

                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Project Comments </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('status.done') }}" method="POST">
        @csrf
            <div class="modal-body">
                <div class="mb-3">
                    <input type="hidden" name="task_id" id="task_id" class="form-control">
                    <textarea name="comments" class="form-control" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('script')
    <script>
        let btn = document.querySelector('.done_btn');
        let value = document.querySelector('.done_btn').dataset.id;
        let task_id = document.querySelector('#task_id');
        btn.onclick = function(){
            task_id.value = value;
        }
        // $(document).ready(function(){
        //     $('.done_btn').click(function(){
        //         var task_id = $(this).data('id');
        //         $('#task_id').val(task_id);
        //     });
        // });
    </script>
@endsection
