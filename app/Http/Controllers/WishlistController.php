<?php

namespace App\Http\Controllers;

use App\Http\Requests\WishlistRequest;
use App\Models\Wishlist;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\WishlistFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class WishlistController extends Controller
{
    public function index(Request $request, WishlistFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Wishlist::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(WishlistRequest $request)
    {
      try {
        $wishlist = Wishlist::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $wishlist, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Wishlist $wishlist)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $wishlist);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(WishlistRequest $request, $id)
    {
      try {
        $checkExist = Wishlist::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Wishlist $wishlist)
    {
      try {
          $response = $wishlist->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
