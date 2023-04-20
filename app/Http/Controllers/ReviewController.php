<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ReviewFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewController extends Controller
{
    public function index(Request $request, ReviewFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Review::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(ReviewRequest $request)
    {
      try {
        $review = Review::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $review, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Review $review)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $review);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function getModifiedSearch(Review $review)
    {
      try {

        Review::select()
        ->join('products', 'reviews.product_id', '=', 'products.id')
        ->join('users', 'reviews.user_id', '=', 'users.id')
        ->select('products.name', 'products.added_by as product_added_by', 'users.name as user_name', 'users.email as user_email', 'reviews.rating', 'reviews.comment')
        ->whereNotNull('products.id')
        ->whereNotNull('users.id')
        ->get();
          return $this->success(ResponseMessage::API_SUCCESS, $review);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(ReviewRequest $request, Review $review)
    {
      try {
          $response = $review->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Review $review)
    {
      try {
          $response = $review->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
