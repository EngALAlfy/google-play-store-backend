<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderItemController
 */
final class OrderItemControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderItemController::class,
            'store',
            \App\Http\Requests\OrderItemStoreRequest::class
        );
    }

    #[Test]
    public function store_saves(): void
    {
        $order = Order::factory()->create();
        $account = Account::factory()->create();
        $price = $this->faker->randomFloat(/** float_attributes **/);
        $description = $this->faker->text();

        $response = $this->post(route('order-items.store'), [
            'order_id' => $order->id,
            'account_id' => $account->id,
            'price' => $price,
            'description' => $description,
        ]);

        $orderItems = OrderItem::query()
            ->where('order_id', $order->id)
            ->where('account_id', $account->id)
            ->where('price', $price)
            ->where('description', $description)
            ->get();
        $this->assertCount(1, $orderItems);
        $orderItem = $orderItems->first();
    }


    #[Test]
    public function destroy_deletes(): void
    {
        $orderItem = OrderItem::factory()->create();

        $response = $this->delete(route('order-items.destroy', $orderItem));

        $this->assertModelMissing($orderItem);
    }
}
