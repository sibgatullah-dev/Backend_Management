<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;

class CategoryController extends Controller
{
    function add_category(){
        $categories = Category::all();
        return view('backend.category.add_category', [
            'categories'=>$categories,
        ]);
    }
    function store_category(Request $request){

        $request->validate([
            'category_name'=>['required', 'unique:categories,category_name'],
            'category_image'=>['required', 'mimes:png,jpg,jpeg,bmp,svg,webp,avif', 'max:2048'], //max:2048 = 2mb validated image extention and size.
        ]);

        $image = $request->category_image;
        $extention = $image->extension();
        $file_name = uniqid().".".$extention;

       $manager = new ImageManager(new Driver());
       $image = $manager->read($image);
       $image->scale(200,200);
       $image->save(public_path('uploads/category/'.$file_name));

       Category::insert([
         'category_name'=>$request->category_name,
         'category_image'=>$file_name,
        //  'slug'=>Str::slug($request->category_name),
         'slug'=>Str::lower(str_replace(' ', '-', $request->category_name)).'-'.uniqid(),
         'created_at'=>Carbon::now(),

       ]);
       return back()->with('success', 'Category added successfully');
    }

    function edit_category($id){
        $category = Category::find($id);
        return view('backend.category.edit',[
        'category'=>$category,
        ]);
    }

    function update_category(Request $request, $id){

        $category = Category::find($id);
        $delete_from = public_path('uploads/category/' .$category->category_image );
        if (file_exists($delete_from)) {
            unlink($delete_from);
        }

        $category = Category::find($id);
        $image = $request->category_image;
        $extention = $image->extension();
        $file_name = uniqid().".".$extention;

       $manager = new ImageManager(new Driver());
       $image = $manager->read($image);
       $image->scale(200,200);
       $image->save(public_path('uploads/category/'.$file_name));

       Category::find($id)->update([
        'category_name'=>$request->category_name,
        'category_image'=>$file_name,
        'slug'=>Str::lower(str_replace(' ', '-', $request->category_name)).'-'.uniqid()
       ]);

    //    $category->category_name = $request->category_name;
    //    $category->category_image = $file_name;
    //    $category->slug = Str::lower(str_replace(' ', '-', $request->category_name)).'-'.uniqid();
    //    $category->save();
    //    return back()->with('success', 'Category updated successfully');
          return redirect()->route('add.category')->with('success', 'Category updated successfully');
    }


    function delete_category($id){
        $category = Category::find($id);
        $delete_from = public_path('uploads/category/' .$category->category_image );
        unlink($delete_from);

        Category::find($id)->delete();

        return back();
    }

    //Trash Mathod for soft delete
    function trash_category(){

        return view('backend.category.trash');

        // $categories = Category::onlyTrashed()->get();
        // return view('backend.category.trash_category', [
        //     'categories' => $categories,
        // ]);
    }
}
