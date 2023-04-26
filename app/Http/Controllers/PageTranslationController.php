<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageTranslationRequest;
use App\Models\PageTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PageTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageTranslationController extends Controller
{
    public function index(Request $request, PageTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = PageTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PageTranslationRequest $request)
    {
      try {
        $page_translation = PageTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $page_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(PageTranslation $page_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $page_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PageTranslationRequest $request, $id)
    {
      try {
        $checkExist = PageTranslation::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(PageTranslation $page_translation)
    {
      try {
          $response = $page_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
