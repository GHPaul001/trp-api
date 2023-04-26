<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStockRequest;
use App\Models\ProductStock;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductStockFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductStockController extends Controller
{
    public function index(Request $request, ProductStockFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = ProductStock::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ProductStockRequest $request)
    {
      try {
        $product_stock = ProductStock::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $product_stock, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(ProductStock $product_stock)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $product_stock);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ProductStockRequest $request, $id)
    {
      try {
        $checkExist = ProductStock::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(ProductStock $product_stock)
    {
      try {
          $response = $product_stock->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
