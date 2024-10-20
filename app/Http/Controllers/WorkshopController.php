<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;

class WorkshopController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $workshops = Workshop::all();
        return $this->success($workshops);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $workshop = Workshop::create([
            'title' => $data['title'],
            'description' => $data['description'],
            'instructor_id' => $data['instructor_id'],
            'date' => $data['date'],
            'time' => $data['time'],
            'capacity' => $data['capacity'],
            'price' => $data['price'],
        ]);
        return $this->success($workshop);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $workshop = Workshop::find($id);
        return $this->success($workshop);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $workshop = Workshop::find($id);
        $workshop->update($data);
        return $this->success($workshop);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return 'Do not use this method';
        $workshop = Workshop::find($id);
        $workshop->delete();
        return $this->success($workshop);
    }

    public function getUserWorkshops(Request $request)
    {
        $user = Auth::user();

        $workshops = $user->workshops()->get();

        return response()->json($workshops);
    }

    public function registerForWorkshop(Request $request, $workshopId)
    {
        // Get the workshop
        $workshop = Workshop::findOrFail($workshopId);
        
        // Count how many users are already registered
        $registeredUsers = $workshop->users()->count();

        // Check if the capacity is full
        if ($registeredUsers >= $workshop->capacity) {
            return response()->json(['message' => 'معذرة، لا يمكنك التسجيل'], 400);
        }

        // Register the user for the workshop
        $user = Auth::user(); 
        $workshop->users()->attach($user->id);

        return response()->json(['message' => 'لقد تم تسجيلك بنجاح'], 200);
    }

    public function getWorkshopUsers($workshopId)
    {
        $workshop = Workshop::findOrFail($workshopId);

        $users = $workshop->users()->get();

        return response()->json($users);
    }
}
