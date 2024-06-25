<?php

namespace App\Actions\Category;

use App\Http\Requests\Api\Category\ListCategoryRequest;
use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListCategoryAction
{
    /**
     * @param ListCategoryRequest $request
     * @return LengthAwarePaginator<Category>
     */
    public function handle(ListCategoryRequest $request): LengthAwarePaginator
    {
        $query = Category::query();

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
