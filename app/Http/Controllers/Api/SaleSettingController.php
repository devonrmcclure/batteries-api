<?php

namespace App\Http\Controllers\Api;

use App\SaleSetting;
use App\Http\Controllers\Controller;
use App\Http\Resources\SaleSetting as SaleSettingResource;

class SaleSettingController extends Controller
{
    public function index()
    {
        $settings = SaleSetting::first();

        return new SaleSettingResource($settings);
    }
}
