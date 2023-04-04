<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Search;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\SearchFilters;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController extends Controller
{
    public function index(Request $request, SearchFilters $filters)
    {
      try {
            $paginate = $request->query('sizePerPage', 25);
            $result = Search::filter($filters)->paginate($paginate);

            return  $this->success(ResponseMessage::API_SUCCESS, $result);
      } catch (\Exception $e) {
            \Log::error($e->getMessage(), $e->getTrace());
            return $this->error($e->getMessage());
      }
    }

    public function store(SearchRequest $request)
    {
      try {
        $search = Search::create($request->validated());

        return $this->success(ResponseMessage::API_SUCCESS, $search, Response::HTTP_CREATED);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
        return $this->error($e->getMessage());
      }
    }

    public function show(Search $search)
    {
      try {
          return $this->success(ResponseMessage::API_SUCCESS, $search);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function update(SearchRequest $request, Search $search)
    {
      try {
          $response = $search->update($request->validated());
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }

    public function destroy(Search $search)
    {
      try {
          $response = $search->delete();
          return $this->success(ResponseMessage::API_SUCCESS, $response);
      } catch (\Exception $e) {
          \Log::error($e->getMessage(), $e->getTrace());
          return $this->error($e->getMessage());
      }
    }
}
