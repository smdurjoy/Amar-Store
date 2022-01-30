<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\JsonResponse;

class CommonAPIController extends Controller
{
    public function getProduct(): JsonResponse
    {
        try {
            $data = Category::query()
                ->where('category_name', 'LIKE', '%' . request()->get('search') . '%')
                ->with(['section' => function ($q) {
                    $q->orWhere('name', 'LIKE', '%' . request()->get('search'));
                }, 'products' => function ($q) {
                    $q->limit(10);
                }])
                ->get()
                ->flatMap(function ($category) {
                    return $category->products->map(function ($product) use ($category) {
                        return [
                            'category_id' => $category->id,
                            'product_id' => $product->id,
                            'product_name' => $product->product_name,
                            'product_image' => $product->product_image,
                        ];
                    });
                });

            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 400);
        }
    }
}
