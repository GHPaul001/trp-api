<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductQueryRequest;
use App\Models\ProductQuery;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductQueryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductQueryController extends Controller
{
    public function index(Request $request, ProductQueryFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = ProductQuery::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ProductQueryRequest $request)
    {
      try {
        $product_query = ProductQuery::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $product_query, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(ProductQuery $product_query)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $product_query);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ProductQueryRequest $request, ProductQuery $product_query)
    {
      try {
          $response = $product_query->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(ProductQuery $product_query)
    {
      try {
          $response = $product_query->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
