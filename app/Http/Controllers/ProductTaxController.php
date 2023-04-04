<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductTaxRequest;
use App\Models\ProductTax;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductTaxFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductTaxController extends Controller
{
    public function index(Request $request, ProductTaxFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = ProductTax::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ProductTaxRequest $request)
    {
      try {
        $product_tax = ProductTax::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $product_tax, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(ProductTax $product_tax)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $product_tax);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ProductTaxRequest $request, ProductTax $product_tax)
    {
      try {
          $response = $product_tax->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(ProductTax $product_tax)
    {
      try {
          $response = $product_tax->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
