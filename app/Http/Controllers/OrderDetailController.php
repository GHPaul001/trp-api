<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderDetailRequest;
use App\Models\OrderDetail;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrderDetailFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderDetailController extends Controller
{
    public function index(Request $request, OrderDetailFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = OrderDetail::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(OrderDetailRequest $request)
    {
      try {
        $order_detail = OrderDetail::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $order_detail, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(OrderDetail $order_detail)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $order_detail);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(OrderDetailRequest $request, OrderDetail $order_detail)
    {
      try {
          $response = $order_detail->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(OrderDetail $order_detail)
    {
      try {
          $response = $order_detail->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
