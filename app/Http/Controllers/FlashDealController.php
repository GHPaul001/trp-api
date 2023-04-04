<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashDealRequest;
use App\Models\FlashDeal;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\FlashDealFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlashDealController extends Controller
{
    public function index(Request $request, FlashDealFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = FlashDeal::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(FlashDealRequest $request)
    {
      try {
        $flash_deal = FlashDeal::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $flash_deal, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(FlashDeal $flash_deal)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $flash_deal);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(FlashDealRequest $request, FlashDeal $flash_deal)
    {
      try {
          $response = $flash_deal->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(FlashDeal $flash_deal)
    {
      try {
          $response = $flash_deal->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
