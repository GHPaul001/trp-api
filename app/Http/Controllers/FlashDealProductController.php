<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashDealProductRequest;
use App\Models\FlashDealProduct;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\FlashDealProductFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlashDealProductController extends Controller
{
    public function index(Request $request, FlashDealProductFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = FlashDealProduct::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(FlashDealProductRequest $request)
    {
      try {
        $flash_deal_product = FlashDealProduct::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $flash_deal_product, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(FlashDealProduct $flash_deal_product)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $flash_deal_product);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(FlashDealProductRequest $request,$id)
    {
      try {
        $checkExist = FlashDealProduct::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(FlashDealProduct $flash_deal_product)
    {
      try {
          $response = $flash_deal_product->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
