<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageRequest;
use App\Models\Page;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\PageFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function index(Request $request, PageFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Page::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(PageRequest $request)
    {
      try {
        $page = Page::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $page, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Page $page)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $page);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(PageRequest $request, $id)
    {
      try {
        $checkExist = Page::find($id);
        $response = $checkExist->update($request->all());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Page $page)
    {
      try {
          $response = $page->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
