<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
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
            'categories' => $categories,
        ]);
    }

    function store_category(Request $request){
        $request->validate([
            'category_name' => ['required', 'unique:categories,category_name'],
            'category_image' => ['required', 'mimes:png,jpg,jpeg,bmp,svg,webp,avif', 'max:2048'], // max:2048 = 2mb validated image extension and size.
        ]);

        $image = $request->category_image;
        $extension = $image->extension();
        $file_name = uniqid() . "." . $extension;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($image);
        $image->scale(200, 200);
        $image->save(public_path('uploads/category/' . $file_name));

        Category::insert([
            'category_name' => $request->category_name,
            'category_image' => $file_name,
            'slug' => Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . uniqid(),
            'created_at' => Carbon::now(),
        ]);

        return back()->with('success', 'Category added successfully');
    }

    function edit_category($id){ // category edit request
        $category = Category::find($id);
        return view('backend.category.edit', [
            'category' => $category,
        ]);
    }

    function update_category(Request $request, $id){ //Edited categroy update and insert request
        $category = Category::find($id);
        $delete_from = public_path('uploads/category/' . $category->category_image);
        if (file_exists($delete_from)) {
            unlink($delete_from);
        }

        $image = $request->category_image;
        $extension = $image->extension();
        $file_name = uniqid() . "." . $extension;

        $manager = new ImageManager(new Driver());
        $image = $manager->read($image);
        $image->scale(200, 200);
        $image->save(public_path('uploads/category/' . $file_name));

        $category->update([
            'category_name' => $request->category_name,
            'category_image' => $file_name,
            'slug' => Str::lower(str_replace(' ', '-', $request->category_name)) . '-' . uniqid(),
        ]);

        return redirect()->route('add.category')->with('success', 'Category updated successfully');
    }

    function delete_category($id){ // Category deleting mathod
        $category = Category::find($id);
        if($category->category_name !='Uncategorized'){
            Category::find($id)->delete();
            return back();
        }
        return back();

    }

    // Trash Method for soft delete
    function trash_category(){
        $trashed = Category::onlyTrashed()->get();
        return view('backend.category.trash', [
            'trashed' => $trashed,
        ]);
    }

    function restore_category($id){
        Category::onlyTrashed()->find($id)->restore();
        return back();
    }

    function pdelete_category($id){ //Permanent delete mathod from trash
        $category = Category::onlyTrashed()->find($id);
        $delete_from = public_path('uploads/category/' . $category->category_image);
        unlink($delete_from);


       $subcate= SubCategory::where('category_id', $id)->get();

       foreach($subcate as $sub){

        SubCategory::find($sub->id)->update([
            'category_id'=>7,
         ]);
       }

        // $category->forceDelete();
        Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('del_success', 'Category deleted permanently! ');
    }

    // Sub Category
    function store_subcategory(Request $request){
        SubCategory::insert([
            'category_id'=>$request->category,
            'subcategory_name'=>$request->subcategory_name,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }

    function edit_subcategory($id){
        $categories = Category::all();
        $subcategory= SubCategory::find($id);
        return view('backend.category.edit_sub',[
            'categories'=>$categories,
            'subcategory'=>$subcategory,
        ]);
    }

    function update_subcategory(Request $request,$id){
        SubCategory::find($id)->update([
            'category_id'=>$request->category,
            'subcategory_name'=>$request->subcategory_name,
        ]);
        return redirect()->route('add.category');
    }
}
