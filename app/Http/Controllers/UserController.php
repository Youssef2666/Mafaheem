<?php

namespace App\Http\Controllers;

use App\Notifications\InvoicePaid;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ResponseTrait;
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
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|string|min:8|confirmed', // password is optional, but if provided, it must be confirmed
            'profile_photo_path' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();

        if ($request->filled('password')) {
            $validatedData['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_photo_path')) {
            $path = $request->file('profile_photo_path')->store('profile-photos', 'public');
            return $path;
            $validatedData['profile_photo_path_path'] = $path;
        }

        // Update the user's data
        $user->update($validatedData);

        return $this->success($user);
    }

    public function getUserNotifications(){
        $user = Auth::user();
        return $user->unreadNotifications;
    }

    // public function testNotification(Request $request){
    //     $user = Auth::user();
    //     return $user->notifications;
    //     $user->notify(new InvoicePaid());
    // }

}
