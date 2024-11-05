<?php

namespace App\Services\SettingServices;

use App\Models\Category;

class CategoryService
{
    public static function make()
    {
        return new static();
    }

    public function get()
    {
        return Category::all();
    }
}
