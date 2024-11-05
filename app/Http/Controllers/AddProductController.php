<?php

namespace App\Http\Controllers;

use App\Services\UserProductService;
use Illuminate\Http\Request;

class AddProductController extends Controller
{
    public function create(Request $request)
    {
        $product = UserProductService::make()
            -setContents($request->contents)
            ->setUser($this->user())
            ->setName($request->name)
            ->setDescription($request->description)
            ->setPrice($request->price)
            ->setAddress($request->address)
            ->setCondition($request->condition)
            ->setExchange($request->exchange)
            ->setCategoryId($request->category_id)
            ->setAddressId($request->address_id)
            ->create();
        return response()
            ->json([
                'data' => $product,
                'message' => 'product added successfully'
            ],201);
    }

    public function get()
    {
        $products = UserProductService::make()
            ->setUser($this->user())
            ->get();
        return response()
            ->json([
                'data' => $products,
                'message' => 'date retrieved'
            ]);
    }

    public function show(int $id)
    {
        $product = UserProductService::make()
            ->setUser($this->user())
            ->show($id);
        return response()
            ->json([
                'data' => $product,
                'message' => 'item retrieved'
            ]);
    }

    public function updatePrice($id, Request $request)
    {
        $product = UserProductService::make()
            ->setUser($this->user())
            ->update($id,$request->price);
        return response()
            ->json([
                'data' => $product,
                'message' => 'updated successfully'
            ]);
    }
}
