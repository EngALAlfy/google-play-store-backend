<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Http\Resources\PlanCollection;
use App\Http\Resources\PlanResource;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanController extends Controller
{
    public function index(Request $request): Response
    {
        $plans = Plan::all();

        return new PlanCollection($plans);
    }

    public function store(PlanStoreRequest $request): Response
    {
        $plan = Plan::create($request->validated());

        return new PlanResource($plan);
    }

    public function show(Request $request, Plan $plan): Response
    {
        return new PlanResource($plan);
    }

    public function update(PlanUpdateRequest $request, Plan $plan): Response
    {
        $plan->update($request->validated());

        return new PlanResource($plan);
    }

    public function destroy(Request $request, Plan $plan): Response
    {
        $plan->delete();

        return response()->noContent();
    }
}
