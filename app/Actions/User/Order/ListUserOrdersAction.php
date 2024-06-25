<?php

namespace App\Actions\User\Order;

use App\Http\Requests\Api\User\Order\ListUserOrdersRequest;
use App\Models\Order;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListUserOrdersAction
{
    /**
     * @param ListUserOrdersRequest $request
     * @return LengthAwarePaginator<Order>
     */
    public function handle(ListUserOrdersRequest $request): LengthAwarePaginator
    {
        $query = Order::where('user_id', optional($request->user())->id)->with(['orderStatus', 'payment']);

        if ($request->filled('sortBy')) {
            $query->orderBy($request->get('sortBy'), $request->get('sort'));
        }

        if ($request->filled('limit')) {
            $result = $query->paginate($request->get('limit') > 20 ? 10 : $request->get('limit'));
        } else {
            $result = $query->paginate(10);
        }

        return $result;
    }
}
