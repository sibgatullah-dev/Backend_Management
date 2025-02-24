<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ToDoController;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\UploadedFile;


// front end
Route::get('/', [frontendController::class, 'welcome']);


// back end
Route::get('/dashboard', [BackendController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard'); //middleware can read data from the database if necessary. >>  In Laravel, middleware can perform various tasks, including reading from the database, to determine whether a request should proceed.




// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

//User
Route::get('/edit/profile', [UserController::class, 'edit_profile'])->name('edit.profile');
Route::post('/update/profile', [UserController::class, 'update_profile'])->name('update.profile');
Route::post('/update/password', [UserController::class, 'update_password'])->name('update.password');
Route::post('/update/picture', [UserController::class, 'update_picture'])->name('update.picture');

//ToDo
Route::get('/to/do', [ToDoController::class, 'todo'])->name('to.do');
Route::post('/to/do/store', [ToDoController::class, 'todo_store'])->name('todo.store');
Route::get('/to/do/delete/{user_id}', [ToDoController::class, 'todo_delete'])->name('todo.delete');

//My Task
Route::get('/my/task', [ToDoController::class, 'my_task'])->name('my.task');
Route::post('/my/task/done', [ToDoController::class, 'my_task_done'])->name('status.done');

//Category
Route::get('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
Route::post('/store/category', [CategoryController::class, 'store_category'])->name('store.category');
Route::get('/delete/category/{id}', [CategoryController::class, 'delete_category'])->name('delete.category');

//Edit Category
Route::get('/edit/category/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('/update/category/{id}', [CategoryController::class, 'update_category'])->name('update.category');



