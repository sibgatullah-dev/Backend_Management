<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;



use function Laravel\Prompts\password;

class UserController extends Controller
{
    function edit_profile(){
        return view('backend.users.edit_profile');
    }

    function update_profile(Request $request){
         User::find(Auth::id())->update([
            'name'=>$request->name,
            'email'=>$request->email,
         ]);
         return back()->with('success', 'Profile updated successfully');
    }
    // Validation for password update
    function update_password(Request $request){
        $request->validate([
            'current_password'=>'required',
            'password'=>['required','confirmed',Password::min(8)
            ->letters()
            ->mixedCase()
            ->numbers()
            ->symbols()],
            'password_confirmation'=>'required',


        ],[
            'current_password.required'=>'Oi hala Current Password de',
        ]);


        if (Hash::check($request->current_password, Auth::user()->password)) {
            User::find(Auth::id())->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('pass_update', 'Password updated successfully!');
        }
        else{
            return back()->with('wrong', 'Current Password is wrong');
        }
    }


    function update_picture(Request $request){
        if(Auth::user()->picture != null){
            $delete_from = public_path('/uploads/user/'.Auth::user()->picture);
            unlink($delete_from);
        }
        $picture = $request->picture;
        $extension = $picture->extension();
        $file_name = uniqid().'.'.$extension;
       $manager = new ImageManager(new Driver());
       $image = $manager->read($picture);
       $image->scale(width: 300);
       $image->toPng()->save(public_path('uploads/user/'. $file_name));

       User::find(Auth::id())->update([
            'picture'=>$file_name,
       ]);
        return back()->with('picture_update', 'Profile Picture updated successfully!');
    }
}
