<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Models\Dashboard;
use App\Enums\ResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Filters\DashboardFilters;
use App\Models\Brands;
use App\Models\Category;
use App\Models\Order;
use App\Models\Shop;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
// use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
  public function index(Request $request, DashboardFilters $filters)
  {
    try {
      $paginate = $request->query('sizePerPage', 25);
      $result = Dashboard::filter($filters)->paginate($paginate);

      return  $this->success(ResponseMessage::API_SUCCESS, $result);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function dashboardDetails(Request $request)
  {
    try {
      $request = collect([
        'user_count' => User::count(),
        'orders_count' => Order::count(),
        'categories_count' => Category::count(),
        'brands_count' => Brands::count(),
        'products_count' => Product::count(),
        'products_added_by_admin' => Product::where('added_by', 'admin')->count(),
        'shops_verified' => Shop::where('verification_status', 1)->count(),
        'shops_not_verified' => Shop::where('verification_status', 0)->count(),
        'products_added_by_seller' => Product::where('added_by', 'seller')->count(),
      ]);
      return  $this->success(ResponseMessage::API_SUCCESS, $request);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function store(DashboardRequest $request)
  {
    try {
      $dashboard = Dashboard::create($request->validated());

      return $this->success(ResponseMessage::API_SUCCESS, $dashboard, Response::HTTP_CREATED);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function show(Dashboard $dashboard)
  {
    try {
      return $this->success(ResponseMessage::API_SUCCESS, $dashboard);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function update(DashboardRequest $request, Dashboard $dashboard)
  {
    try {
      $response = $dashboard->update($request->validated());
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }

  public function destroy(Dashboard $dashboard)
  {
    try {
      $response = $dashboard->delete();
      return $this->success(ResponseMessage::API_SUCCESS, $response);
    } catch (\Exception $e) {
      \Log::error($e->getMessage(), $e->getTrace());
      return $this->error($e->getMessage());
    }
  }
}
