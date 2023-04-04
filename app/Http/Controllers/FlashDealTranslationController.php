<?php

namespace App\Http\Controllers;

use App\Http\Requests\FlashDealTranslationRequest;
use App\Models\FlashDealTranslation;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\FlashDealTranslationFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FlashDealTranslationController extends Controller
{
    public function index(Request $request, FlashDealTranslationFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = FlashDealTranslation::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(FlashDealTranslationRequest $request)
    {
      try {
        $flash_deal_translation = FlashDealTranslation::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $flash_deal_translation, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(FlashDealTranslation $flash_deal_translation)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $flash_deal_translation);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(FlashDealTranslationRequest $request, FlashDealTranslation $flash_deal_translation)
    {
      try {
          $response = $flash_deal_translation->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(FlashDealTranslation $flash_deal_translation)
    {
      try {
          $response = $flash_deal_translation->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
