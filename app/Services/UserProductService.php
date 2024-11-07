<?php

namespace App\Services;

use App\Models\Product;
use App\Traits\ServiceTrait;
class UserProductService
{
    use ServiceTrait;

    protected $user;
    protected string $name;
    protected string $description;
    protected string $price;
    protected string $address;
    protected string $condition;
    protected bool $exchange;
    protected $categoryId;
    protected $addressid;
    protected $contents;
    public static function make()
    {
        return new static();
    }

    public function create()
    {
        $product = Product::query()
            ->create([
                'user_id' =>$this->user->id,
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->price,
                'condition' => $this->condition,
                'address' => $this->address,
                'category_id' => $this->categoryId,
                'address_id' => $this->addressid
            ]);
        if ($this->exchange == 1)
        {
            $product->update([
                'exchange' => $this->exchange
            ]);
            $product->refresh();
        }

        if ($this->contents)
        {
            $firstRun = true;
            foreach ($this->contents as $content)
            {
                $this->saveContent($product,$content,$firstRun);
                if ($firstRun)
                {
                    $firstRun = false;
                }
            }
        }
        return $product;
    }

    public function get()
    {
        return Product::query()
            ->with(['firstPic'])
            ->where('user_id',$this->user->id)
            ->paginate(15);
    }

    public function show($id)
    {
        return Product::query()
            ->with([
                'address',
                'category',
                'contents'
            ])
            ->where('user_id',$this->user->id)
            ->findOrFail($id);
    }

    public function update(int $id, $newPrice)
    {
        $product = Product::query()
            ->where('user_id',$this->user->id)
            ->findOrFail($id);
        $product->update([
            'price' => $newPrice
        ]);
        $product->refresh();
        return $product;
    }
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    public function setCondition($condition)
    {
        $this->condition = $condition;
        return $this;
    }
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    public function setExchange($exchange = null)
    {
        $this->exchange = $exchange;
        return $this;
    }

    public function setAddressId($addressid)
    {
        $this->addressid = $addressid;
        return $this;
    }

    public function setCategoryId($categoryId)
    {
        $this->categoryId = $categoryId;
        return $this;
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setContents($contents)
    {
        $this->contents = $contents;
        return $this;
    }
}
