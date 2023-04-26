<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CartFilters;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CartController extends Controller
{
    public function index(Request $request, CartFilters $filters)
    {
      try {
            // return 'Hi';
            $paginate = $request->query('sizePerPage', 25);
            $result = Cart::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CartRequest $request)
    {
      try {
        $cart = Cart::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $cart, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Cart $cart)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $cart);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CartRequest $request, $id)
    {
      try {
        $checkExist = Cart::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Cart $cart)
    {
      try {
          $response = $cart->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
