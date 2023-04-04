<?php

namespace App\Http\Controllers;

use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\LanguageFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LanguageController extends Controller
{
    public function index(Request $request, LanguageFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Language::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(LanguageRequest $request)
    {
      try {
        $language = Language::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $language, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Language $language)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $language);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(LanguageRequest $request, Language $language)
    {
      try {
          $response = $language->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Language $language)
    {
      try {
          $response = $language->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
