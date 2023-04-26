<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaykuTransactionRequest;
use App\Models\PaykuTransaction;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PaykuTransactionFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaykuTransactionController extends Controller
{
    public function index(Request $request, PaykuTransactionFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PaykuTransaction::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PaykuTransactionRequest $request)
    {
      try {
        $payku_transaction = PaykuTransaction::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $payku_transaction, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PaykuTransaction $payku_transaction)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $payku_transaction);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PaykuTransactionRequest $request,$id )
    {
      try {
        $checkExist = PaykuTransaction::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PaykuTransaction $payku_transaction)
    {
      try {
          $response = $payku_transaction->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
