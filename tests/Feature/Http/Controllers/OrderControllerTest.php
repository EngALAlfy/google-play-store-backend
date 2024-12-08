<?php

namespace Tests\Feature\Http\Controllers;

use App\Events\NewOrderPlaced;
use App\Jobs\ProcessOrder;
use App\Models\Account;
use App\Models\Broker;
use App\Models\Buyer;
use App\Models\Order;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
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
        $seller = Seller::factory()->create();
        $account = Account::factory()->create();
        $broker = Broker::factory()->create();
        $total_price = $this->faker->randomFloat(/** float_attributes **/);
        $description = $this->faker->text();

        Queue::fake();
        Event::fake();

        $response = $this->post(route('orders.store'), [
            'buyer_id' => $buyer->id,
            'seller_id' => $seller->id,
            'account_id' => $account->id,
            'broker_id' => $broker->id,
            'total_price' => $total_price,
            'description' => $description,
        ]);

        $orders = Order::query()
            ->where('buyer_id', $buyer->id)
            ->where('seller_id', $seller->id)
            ->where('account_id', $account->id)
            ->where('broker_id', $broker->id)
            ->where('total_price', $total_price)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        Queue::assertPushed(ProcessOrder::class, function ($job) use ($order) {
            return $job->order->is($order);
        });
        Event::assertDispatched(NewOrderPlaced::class, function ($event) use ($order) {
            return $event->order->is($order);
        });
    }


    #[Test]
    public function show_behaves_as_expected(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));
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
        $total_price = $this->faker->randomFloat(/** float_attributes **/);
        $description = $this->faker->text();

        $response = $this->put(route('orders.update', $order), [
            'total_price' => $total_price,
            'description' => $description,
        ]);

        $order->refresh();

        $this->assertEquals($total_price, $order->total_price);
        $this->assertEquals($description, $order->description);
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $this->assertModelMissing($order);
    }
}
