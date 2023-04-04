<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerProductRequest;
use App\Models\CustomerProduct;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CustomerProductFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerProductController extends Controller
{
    public function index(Request $request, CustomerProductFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CustomerProduct::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CustomerProductRequest $request)
    {
      try {
        $customer_product = CustomerProduct::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $customer_product, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CustomerProduct $customer_product)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $customer_product);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CustomerProductRequest $request, CustomerProduct $customer_product)
    {
      try {
          $response = $customer_product->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CustomerProduct $customer_product)
    {
      try {
          $response = $customer_product->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
