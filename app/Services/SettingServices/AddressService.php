<?php

namespace App\Services\SettingServices;

use App\Models\Address;

class AddressService
{
    public static function make()
    {
        return new static();
    }

    public function get()
    {
        return Address::query()
            ->whereNull('parent_id')
            ->get();
    }

    public function show(int $id)
    {
        return Address::query()
            ->with([
                'children'
            ])
            ->findOrFail($id);
    }
}
