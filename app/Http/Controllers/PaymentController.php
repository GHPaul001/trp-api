<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PaymentFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PaymentController extends Controller
{
    public function index(Request $request, PaymentFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Payment::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PaymentRequest $request)
    {
      try {
        $payment = Payment::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $payment, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Payment $payment)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $payment);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PaymentRequest $request, $id)
    {
      try {
        $checkExist = Payment::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Payment $payment)
    {
      try {
          $response = $payment->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
