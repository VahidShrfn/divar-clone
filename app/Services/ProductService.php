<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{
    public static function make()
    {
        return new static();
    }

    public function getAll()
    {
        return Product::query()
            ->with(['firstPic']);
    }

    public function filterCategory($product,$categoryId)
    {
        return $product->where('category_id',$categoryId);
    }

    public function filterByAddress($product,$addressId)
    {
        return $product->where('address_id',$addressId);
    }
    public function get($product)
    {
        return $product->paginate(15);
    }

    public function show(int $id)
    {
        return Product::query()
            ->with([
                'address',
                'category',
                'contents',
                'user'
            ])
            ->findOrFail($id);
    }
}
