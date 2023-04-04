<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerWithdrawRequestRequest;
use App\Models\SellerWithdrawRequest;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\SellerWithdrawRequestFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SellerWithdrawRequestController extends Controller
{
    public function index(Request $request, SellerWithdrawRequestFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = SellerWithdrawRequest::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(SellerWithdrawRequestRequest $request)
    {
      try {
        $seller_withdraw_request = SellerWithdrawRequest::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $seller_withdraw_request, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(SellerWithdrawRequest $seller_withdraw_request)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $seller_withdraw_request);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(SellerWithdrawRequestRequest $request, SellerWithdrawRequest $seller_withdraw_request)
    {
      try {
          $response = $seller_withdraw_request->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(SellerWithdrawRequest $seller_withdraw_request)
    {
      try {
          $response = $seller_withdraw_request->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
