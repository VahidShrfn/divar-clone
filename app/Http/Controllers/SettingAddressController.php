<?php

namespace App\Http\Controllers;

use App\Services\SettingServices\AddressService;
use Illuminate\Http\Request;

class SettingAddressController extends Controller
{
    public function get()
    {
        $addresses = AddressService::make()
            ->get();
        return response()
            ->json([
                'data' => $addresses,
                'message' => 'successful'
            ]);
    }

    public function show(int $id)
    {
        $address = AddressService::make()
            ->show($id);
        return response()
            ->json([
                'data' => $address,
                'message' => 'successful'
            ]);
    }
}
