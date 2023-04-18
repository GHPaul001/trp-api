<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\ProductFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
  public function index(Request $request, ProductFilters $filters)
  {
    try {
      
      $request = Product::select('name', 'thumbnail_img', 'rating', 'unit_price')
        ->where('published', '=', 1)
        ->where('added_by', '=', 'admin')
        ->orderBy('num_of_sale', 'desc')
        ->limit(12);

      $products = $filters->apply($request)->get();
      // $paginate = $request->query('sizePerPage', 12);
      // $result = Product::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $products);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(ProductRequest $request)
  {
    try {
      $product = Product::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $product, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(Product $product)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $product);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function getalldigitalproducts(Product $product)
  {
    try {
       $product = Product::get([ 'slug', 'added_by', 'thumbnail_img', 'unit_price', 'todays_deal', 'id', 'published']);
      return $this->success(ResponseMessage::API_SUCCESS, $product);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
  
  public function update(ProductRequest $request, $id)
  {
    try {

      $checkExist = Product::findOrFail($id);
      $response = $checkExist->update($request->all());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(Product $product)
  {
    try {
      $response = $product->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
