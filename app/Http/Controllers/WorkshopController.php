<?php

namespace App\Http\Controllers;

use App\Models\Workshop;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

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
}
