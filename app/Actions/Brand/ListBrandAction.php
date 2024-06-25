<?php

namespace App\Actions\Brand;

use App\Http\Requests\Api\Brand\ListBrandRequest;
use App\Models\Brand;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListBrandAction
{
    /**
     * @param ListBrandRequest $request
     * @return LengthAwarePaginator<Brand>
     */
    public function handle(ListBrandRequest $request): LengthAwarePaginator
    {
        $query = Brand::query();

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
