<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\OrderFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    public function index(Request $request, OrderFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Order::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(OrderRequest $request)
    {
      try {
        $order = Order::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $order, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Order $order)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $order);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(OrderRequest $request,$id)
    {
      try {
        $checkExist = Order::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Order $order)
    {
      try {
          $response = $order->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
