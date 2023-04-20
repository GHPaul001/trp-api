<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CategoryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    try {

    
        $columnNames = explode(',',$request->input('column_name'));
        $result = Category::get($columnNames);
        return response()->json($result);
      // $result = Category::pluck($columnName);
      // return response()->json($result);
      // $paginate = $request->query('sizePerPage', 25);
      // $result = Category::filter($filters)->paginate($paginate);

      // return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(CategoryRequest $request)
  {
    try {
      $category = Category::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $category, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function getallcategories(Category $request)
  {
    try {
      $request = Category::where('level',0)->get(['name']);

      return $this->success(ResponseMessage::API_SUCCESS, $request, Response::HTTP_OK);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function getdigitalcategories(Category $request)
  {
    try {
      $request = Category::get(['id','name']);

      return $this->success(ResponseMessage::API_SUCCESS, $request, Response::HTTP_OK);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }



  public function getStock(Category $category)
  {
    try {
      $category = Category::select()
        ->join('products', 'categories.id', '=', 'products.category_id')
        ->select('categories.name', 'products.current_stock')
        ->where('categories.level', '=', 0)
        ->get();

      return $this->success(ResponseMessage::API_SUCCESS, $category);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(Category $category)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $category);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(CategoryRequest $request, Category $category)
  {
    try {
      $response = $category->update($request->validated());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(Category $category)
  {
    try {
      $response = $category->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
