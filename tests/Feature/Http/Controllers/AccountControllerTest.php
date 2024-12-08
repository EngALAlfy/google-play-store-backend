<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Account;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\AccountController
 */
final class AccountControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $accounts = Account::factory()->count(3)->create();

        $response = $this->get(route('accounts.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AccountController::class,
            'store',
            \App\Http\Requests\AccountStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $seller = Seller::factory()->create();
        $creation_date = Carbon::parse($this->faker->date());
        $apps_count = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $user = User::factory()->create();

        $response = $this->post(route('accounts.store'), [
            'seller_id' => $seller->id,
            'creation_date' => $creation_date->toDateString(),
            'apps_count' => $apps_count,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $accounts = Account::query()
            ->where('seller_id', $seller->id)
            ->where('creation_date', $creation_date)
            ->where('apps_count', $apps_count)
            ->where('price', $price)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $accounts);
        $account = $accounts->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $account = Account::factory()->create();

        $response = $this->get(route('accounts.show', $account));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\AccountController::class,
            'update',
            \App\Http\Requests\AccountUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $account = Account::factory()->create();
        $seller = Seller::factory()->create();
        $creation_date = Carbon::parse($this->faker->date());
        $apps_count = $this->faker->numberBetween(-10000, 10000);
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $user = User::factory()->create();

        $response = $this->put(route('accounts.update', $account), [
            'seller_id' => $seller->id,
            'creation_date' => $creation_date->toDateString(),
            'apps_count' => $apps_count,
            'price' => $price,
            'user_id' => $user->id,
        ]);

        $account->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($seller->id, $account->seller_id);
        $this->assertEquals($creation_date, $account->creation_date);
        $this->assertEquals($apps_count, $account->apps_count);
        $this->assertEquals($price, $account->price);
        $this->assertEquals($user->id, $account->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $account = Account::factory()->create();

        $response = $this->delete(route('accounts.destroy', $account));

        $response->assertNoContent();

        $this->assertModelMissing($account);
    }
}
