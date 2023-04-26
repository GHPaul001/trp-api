<?php

namespace App\Http\Controllers;

use App\Http\Requests\CombineOrderRequest;
use App\Models\CombineOrder;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CombineOrderFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CombineOrderController extends Controller
{
    public function index(Request $request, CombineOrderFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CombineOrder::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CombineOrderRequest $request)
    {
      try {
        $combine_order = CombineOrder::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $combine_order, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CombineOrder $combine_order)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $combine_order);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CombineOrderRequest $request, $id)
    {
      try {
        $checkExist = CombineOrder::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CombineOrder $combine_order)
    {
      try {
          $response = $combine_order->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
