<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Account;
use App\Models\Seller;
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
        $description = $this->faker->text();
        $price = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->post(route('accounts.store'), [
            'seller_id' => $seller->id,
            'creation_date' => $creation_date,
            'apps_count' => $apps_count,
            'description' => $description,
            'price' => $price,
        ]);

        $accounts = Account::query()
            ->where('seller_id', $seller->id)
            ->where('creation_date', $creation_date)
            ->where('apps_count', $apps_count)
            ->where('description', $description)
            ->where('price', $price)
            ->get();
        $this->assertCount(1, $accounts);
        $account = $accounts->first();
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $account = Account::factory()->create();

        $response = $this->get(route('accounts.show', $account));
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
        $creation_date = Carbon::parse($this->faker->date());
        $apps_count = $this->faker->numberBetween(-10000, 10000);
        $description = $this->faker->text();
        $price = $this->faker->randomFloat(/** float_attributes **/);

        $response = $this->put(route('accounts.update', $account), [
            'creation_date' => $creation_date,
            'apps_count' => $apps_count,
            'description' => $description,
            'price' => $price,
        ]);

        $account->refresh();

        $this->assertEquals($creation_date, $account->creation_date);
        $this->assertEquals($apps_count, $account->apps_count);
        $this->assertEquals($description, $account->description);
        $this->assertEquals($price, $account->price);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $account = Account::factory()->create();

        $response = $this->delete(route('accounts.destroy', $account));

        $this->assertModelMissing($account);
    }
}
