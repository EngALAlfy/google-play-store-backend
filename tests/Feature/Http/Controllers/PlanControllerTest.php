<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Plan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PlanController
 */
final class PlanControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $plans = Plan::factory()->count(3)->create();

        $response = $this->get(route('plans.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlanController::class,
            'store',
            \App\Http\Requests\PlanStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $name = $this->faker->name();
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $accounts_count = $this->faker->numberBetween(-10000, 10000);
        $old_accounts = $this->faker->boolean();

        $response = $this->post(route('plans.store'), [
            'name' => $name,
            'price' => $price,
            'accounts_count' => $accounts_count,
            'old_accounts' => $old_accounts,
        ]);

        $plans = Plan::query()
            ->where('name', $name)
            ->where('price', $price)
            ->where('accounts_count', $accounts_count)
            ->where('old_accounts', $old_accounts)
            ->get();
        $this->assertCount(1, $plans);
        $plan = $plans->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $plan = Plan::factory()->create();

        $response = $this->get(route('plans.show', $plan));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PlanController::class,
            'update',
            \App\Http\Requests\PlanUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $plan = Plan::factory()->create();
        $name = $this->faker->name();
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $accounts_count = $this->faker->numberBetween(-10000, 10000);
        $old_accounts = $this->faker->boolean();

        $response = $this->put(route('plans.update', $plan), [
            'name' => $name,
            'price' => $price,
            'accounts_count' => $accounts_count,
            'old_accounts' => $old_accounts,
        ]);

        $plan->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($name, $plan->name);
        $this->assertEquals($price, $plan->price);
        $this->assertEquals($accounts_count, $plan->accounts_count);
        $this->assertEquals($old_accounts, $plan->old_accounts);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $plan = Plan::factory()->create();

        $response = $this->delete(route('plans.destroy', $plan));

        $response->assertNoContent();

        $this->assertModelMissing($plan);
    }
}
