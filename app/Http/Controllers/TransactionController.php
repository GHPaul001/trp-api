<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionRequest;
use App\Models\Transaction;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\TransactionFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    public function index(Request $request, TransactionFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Transaction::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(TransactionRequest $request)
    {
      try {
        $transaction = Transaction::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $transaction, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Transaction $transaction)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $transaction);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(TransactionRequest $request, Transaction $transaction)
    {
      try {
          $response = $transaction->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Transaction $transaction)
    {
      try {
          $response = $transaction->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
