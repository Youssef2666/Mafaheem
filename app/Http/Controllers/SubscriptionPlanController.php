<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubscriptionPlanResource;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;
use App\Models\SubscriptionPlan;

class SubscriptionPlanController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        $subscriptionPlans = SubscriptionPlan::all();
        return $this->success($subscriptionPlans);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $subscriptionPlan = SubscriptionPlan::create($data);
        return $this->success($subscriptionPlan);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $subscriptionPlan = SubscriptionPlan::find($id);
        return $this->success(SubscriptionPlanResource::collection($subscriptionPlan));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->all();
        $subscriptionPlan = SubscriptionPlan::find($id);
        $subscriptionPlan->update($data);
        return $this->success($subscriptionPlan);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subscriptionPlan = SubscriptionPlan::find($id);
        $subscriptionPlan->delete();
        return $this->success($subscriptionPlan);
    }
}
