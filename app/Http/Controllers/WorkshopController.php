<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\WorkshopResource;

class WorkshopController extends Controller
{
    use ResponseTrait;
    public function index()
{
    $workshops = Workshop::with(['instructor', 'categories', 'users'])->get();
    return $this->success(WorkshopResource::collection($workshops));
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
        $workshop = Workshop::with('instructor','categories')->find($id);
        return $this->success(new WorkshopResource($workshop));
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
        
        $registeredUsers = $workshop->users()->count();

        // Check if the capacity is full
        if ($registeredUsers >= $workshop->capacity) {
            return $this->error('عذرًا، الورشة ممتلئة ولا يمكنك التسجيل', 400);
        }

        $user = Auth::user(); 

        if ($workshop->users()->where('user_id', $user->id)->exists()) {
            return $this->error('لقد قمت بالتسجيل في هذه الورشة بالفعل', 400);
        }

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
