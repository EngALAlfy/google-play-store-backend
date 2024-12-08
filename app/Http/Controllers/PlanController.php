<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlanStoreRequest;
use App\Http\Requests\PlanUpdateRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlanController extends Controller
{
    public function index(Request $request): Response
    {
        $plans = Plan::all();
    }

    public function store(PlanStoreRequest $request): Response
    {
        $plan = Plan::create($request->validated());
    }

    public function show(Request $request, Plan $plan): Response
    {
        $plan = Plan::find($id);
    }

    public function update(PlanUpdateRequest $request, Plan $plan): Response
    {
        $plan = Plan::find($id);


        $plan->update($request->validated());
    }

    public function destroy(Request $request, Plan $plan): Response
    {
        $plan = Plan::find($id);

        $plan->delete();
    }
}
