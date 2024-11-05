<?php

namespace App\Http\Controllers;

use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function get(Request $request)
    {
        $service = ProductService::make();
        $products = $service
            ->getAll();
        if ($request->has('address_id'))
            $products = $service->filterByAddress($products,$request->address_id);
        if ($request->has('category_id'))
            $products = $service->filterCategory($products, $request->category_id);
        $products = $service->get($products);
        return response()
            ->json([
                'data' => $products,
                'message' => 'successful'
            ]);
    }

    public function show(int $id)
    {
        $product = ProductService::make()
            ->show($id);
    }
}
