<?php

namespace App\Traits;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class ResponserTest  {

     public function showAlls($collection, $code = 200) {
        if ($collection->isEmpty()) {
            return $this->successResponse(['data' => $collection], $code);
        }
        if ($collection instanceof Collection) {
            $collection = $this->paginateCollection($collection);
        }
        $resource = $collection->first()->resource;
        $transformedCollection = $resource::collection($collection);
        return $this->successResponse($transformedCollection, $code);
    }

    public function successResponse($data, $code) {
        // return $data->response()->setStatusCode($code);
        return response()->json(['data' => $data], $code);
    }

    public function paginateCollection(Collection $collection)
    {
        $perPage = $this->determinePageSize();
        $page = LengthAwarePaginator::resolveCurrentPage();
        $results = $collection->slice(($page - 1) * $perPage, $perPage)
            ->values();
        $paginated = new LengthAwarePaginator($results, $collection->count(), $perPage, $page, [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
        ]);
        $paginated->appends(request()->query());
        return $paginated;
    }

    public function determinePageSize()
    {
        $rules = [
            'per_page' => 'integer|min:2|max:50',
        ];
        $perPage = request()->validate($rules);
        return isset($perPage['per_page']) ? (int) $perPage['per_page'] : 5;
    }



}
