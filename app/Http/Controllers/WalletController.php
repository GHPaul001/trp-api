<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletRequest;
use App\Models\Wallet;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\WalletFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WalletController extends Controller
{
    public function index(Request $request, WalletFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Wallet::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(WalletRequest $request)
    {
      try {
        $wallet = Wallet::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $wallet, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Wallet $wallet)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $wallet);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(WalletRequest $request, Wallet $wallet)
    {
      try {
          $response = $wallet->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Wallet $wallet)
    {
      try {
          $response = $wallet->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
