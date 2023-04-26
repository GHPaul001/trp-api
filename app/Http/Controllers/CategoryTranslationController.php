<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryTranslationRequest;
use App\Models\CategoryTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\CategoryTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryTranslationController extends Controller
{
    public function index(Request $request, CategoryTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = CategoryTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(CategoryTranslationRequest $request)
    {
      try {
        $category_translation = CategoryTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $category_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(CategoryTranslation $category_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $category_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(CategoryTranslationRequest $request, $id)
    {
      try {
        $checkExist = CategoryTranslation::findOrFail($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(CategoryTranslation $category_translation)
    {
      try {
          $response = $category_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
