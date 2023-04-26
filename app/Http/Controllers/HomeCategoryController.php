<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeCategoryRequest;
use App\Models\HomeCategory;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\HomeCategoryFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeCategoryController extends Controller
{
    public function index(Request $request, HomeCategoryFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = HomeCategory::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(HomeCategoryRequest $request)
    {
      try {
        $home_category = HomeCategory::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $home_category, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(HomeCategory $home_category)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $home_category);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(HomeCategoryRequest $request, $id)
    {
      try {
        $checkExist = HomeCategory::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(HomeCategory $home_category)
    {
      try {
          $response = $home_category->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
