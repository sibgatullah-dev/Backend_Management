<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Todo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class ToDoController extends Controller
{
   function todo(){
    $users = User::all();
    $tasks= Todo::all();
    return view('backend.todo.todo', compact('users','tasks'));
   }

   function todo_store(Request $request){
     Todo::insert([
        'task_name'=>$request->task_name,
        'date'=>$request->date,
        'assigned_to'=>$request->assign_to,
        'assigned_by'=>FacadesAuth::id(),
        'created_at'=>Carbon::now(),

     ]);
     return redirect()->back()->with('tasksuccess' , 'New Task Added');


   }
   function todo_delete($user_id){
    Todo::find($user_id)->delete();
    return back();

   }


   function my_task(){
    $tasks = Todo::where('assigned_to', FacadesAuth::id())->get();
    return view('backend.todo.my_task', compact('tasks'));
   }
   function my_task_done(Request $request ){
     Todo::find($request->task_id)->update([
       'status'=>1,
       'comments'=>$request->comments,
     ]);
     return back();
   }


}
