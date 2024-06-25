<?php

namespace App\Http\Resources;

use App\Models\OrderStatus;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property string $user_id
 * @property OrderStatus $orderStatus
 * @property Payment $payment
 * @property string $uuid
 * @property array<string, string> $products
 * @property array<string, string> $address
 * @property float $delivery_fee
 * @property float $amount
 * @property Carbon $shipped_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => $this->user_id,
            'order_status' => OrderStatusResource::make($this->orderStatus),
            'payment' => PaymentResource::make($this->payment),
            'uuid' => $this->uuid,
            'products' => $this->products,
            'address' => $this->address,
            'delivery_fee' => $this->delivery_fee,
            'amount' => $this->amount,
            'shipped_at' => $this->shipped_at->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
