<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReviewRequest;
use App\Models\Review;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ReviewFilters;
use App\Models\Brands;
use App\Models\Category;
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

      $review = Review::select()
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

  public function getBrandReview(Brands $review)
  {
    try {
      $review = Brands::select('brands.id', 'brand_translations.name')
        ->join('brand_translations', 'brand_translations.brand_ id', '=', 'brands.id')
        ->get();
      return $this->success(ResponseMessage::API_SUCCESS, $review);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function getCategoryReview(Category $categories)
  {
    try {
      $categories = Category::select('categories.id', 'category_translations.name', 'categories.parent_id')
        ->join('category_translations', 'category_translations.category_id', '=', 'categories.id')
        ->get();
      return $this->success(ResponseMessage::API_SUCCESS, $categories);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function getCategoriesAttribute(Category $categories)
  {
    try {
      $categories = Category::select('attributes.id', 'attributes.name')
        ->join('attribute_category', 'attribute_category.category_id', '=', 'categories.id')
        ->join('attributes', 'attribute_category.attribute_id', '=', 'attributes.id')
        ->get();
      return $this->success(ResponseMessage::API_SUCCESS, $categories);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(ReviewRequest $request, $id)
  {
    try {
      $checkExist = Review::find($id);
      $response = $checkExist->update($request->all());
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
