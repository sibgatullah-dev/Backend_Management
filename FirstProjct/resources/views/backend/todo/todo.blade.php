@extends('admin')
@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header"><h3>Task List</h3></div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Task</th>
                        <th>Deadline</th>
                        <th>Assigned To</th>
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
                                <td>{{ $task->rel_to_user2->name }}</td>
                                <td>{{ $task->rel_to_user->name }}</td>
                                <td class="text-center fs-4">
                                    <span class="badge badge-{{ $task->status==0?'secondary':'success' }}">{{ $task->status==0?'Undone':'Done' }}</span>
                                </td>

                            <td>
                                <a href="{{ route('todo.delete', $task->id) }}" class="btn btn-danger trash_btn"><i class="fa-solid fa-trash-can"></i></a>
                                <a href="{{ route('to.do', $task->id) }}" class="btn btn-info view_btn" data-comments="{{ $task->comments }}" data-toggle="modal" data-target="#exampleModal"><i class="fa-solid fa-eye"></i></a>
                                {{--   --}}
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
                                </style>
                            </td>

                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header bg-primary text-white"><h3>Add New Tasks</h3></div>
            <div class="card-body">
                <form action="{{ route('todo.store') }}" method = "POST">
                    @if(session('tasksuccess'))
                        <div class="alert alert-success">{{ session('tasksuccess') }}</div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Task Name</label>
                        <input type="text" class="form-control" name="task_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deadline</label>
                        <input type="date" class="form-control" name="date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Assigned User</label>
                        <select name="assign_to" class="form-control">
                            @foreach ($users as $user)
                                  <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary form-control">Add Task</button>
                    </div>
                </form>
            </div>
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

            <div class="modal-body">
                <div class="mb-3">
                    {{-- <input type="text" name="task_id" id="task_id" class="form-control "> --}}
                    <textarea name="comments" class="form-control view_comment" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>

      </div>
    </div>
  </div> 

@endsection

@section('script')
    <script>
        $('.view_btn').click(function(){
           let comments = $(this).data('comments');
           $('.view_comment').html(comments);
        })
    </script>
@endsection
