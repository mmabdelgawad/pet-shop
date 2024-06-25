<?php

namespace App\Actions\Promotion;

use App\Http\Requests\Api\Promotion\ListPromotionRequest;
use App\Models\Promotion;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListPromotionAction
{
    /**
     * @param ListPromotionRequest $request
     * @return LengthAwarePaginator<Promotion>
     */
    public function handle(ListPromotionRequest $request): LengthAwarePaginator
    {
        $query = Promotion::query();

        if ($request->filled('valid')) {
            $request->get('valid') ? $query->valid() : $query->invalid();
        }

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
