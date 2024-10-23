<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;


    public function getMyCourses()
    {
        $user = Auth::user();
        $courses = $user->orders()->get();
        return $this->success($courses);
    }

    public function getMyCertificates()
    {
        $user = Auth::user();
        $certificates = $user->certificates()->get();
        return $this->success($certificates);
    }

    public function getMyRoadMaps()
    {
        $user = Auth::user();
        $roadmaps = $user->roadMapEnrollments()->get();
        return $this->success($roadmaps);
    }

    public function updateUser(Request $request)
    {

        // return $request->all();
        $validatedData = $request->validate([
            'name' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // password is optional, but if provided, it must be confirmed
            // 'image' => 'nullable|image|mimes:jpg,jpeg,png|max:100048',
        ]);

        $user = Auth::user();

        // $user->image = "request->image";
        // $user->save();

        // Update password if provided
        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        // Check if a profile photo was uploaded
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profile-photos-new', 'public');
            $user->image = $path; // Update the validated data with the new path
            $validatedData['profile_photo_path'] = $path; // Update the validated data with the new path
            //   return[$validatedData['image'] ,$path];
            
        }
        
        // return $validatedData;
        
        
        // Update the user's data
        $user->update($validatedData);
        $user->save();
        return $this->success($user);
    }

    public function getUserNotifications()
    {
        $user = Auth::user();
        return $user->unreadNotifications;
    }

    // public function testNotification(Request $request){
    //     $user = Auth::user();
    //     return $user->notifications;
    //     $user->notify(new InvoicePaid());
    // }

}
