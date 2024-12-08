<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Buyer;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_behaves_as_expected(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $buyer = Buyer::factory()->create();
        $total_price = $this->faker->randomFloat(/** float_attributes **/);
        $user = User::factory()->create();

        $response = $this->post(route('orders.store'), [
            'buyer_id' => $buyer->id,
            'total_price' => $total_price,
            'user_id' => $user->id,
        ]);

        $orders = Order::query()
            ->where('buyer_id', $buyer->id)
            ->where('total_price', $total_price)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertCreated();
        $response->assertJsonStructure([]);
    }


    #[Test]
    public function show_responds_with(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertJson($200 with:order);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_behaves_as_expected(): void
    {
        $order = Order::factory()->create();
        $buyer = Buyer::factory()->create();
        $total_price = $this->faker->randomFloat(/** float_attributes **/);
        $user = User::factory()->create();

        $response = $this->put(route('orders.update', $order), [
            'buyer_id' => $buyer->id,
            'total_price' => $total_price,
            'user_id' => $user->id,
        ]);

        $order->refresh();

        $response->assertOk();
        $response->assertJsonStructure([]);

        $this->assertEquals($buyer->id, $order->buyer_id);
        $this->assertEquals($total_price, $order->total_price);
        $this->assertEquals($user->id, $order->user_id);
    }


    #[Test]
    public function destroy_deletes_and_responds_with(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertNoContent();

        $this->assertModelMissing($order);
    }
}
