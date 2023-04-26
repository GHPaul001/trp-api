<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\BlogCategoryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlogCategoryController extends Controller
{
    public function index(Request $request, BlogCategoryFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = BlogCategory::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(BlogCategoryRequest $request)
    {
      try {
        $blog_category = BlogCategory::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $blog_category, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(BlogCategory $blog_category)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $blog_category);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(BlogCategoryRequest $request, $id)
    {
      try {
        $checkExist = BlogCategory::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(BlogCategory $blog_category)
    {
      try {
          $response = $blog_category->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
