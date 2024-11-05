<?php




function getProvinces()
{
    $service = new \App\Services\StateService();
    return $service->getAllProvinces();
}
function getCities(int $id)
{
    $service = new \App\Services\StateService();
    return $service->getCitiesByProvinceId($id);
}
function getProvincesData()
{
    return \App\Models\State::query()
        ->whereNull('parent_id')
        ->get();
}
function getProvinceCitiesData()
{
    return \App\Models\State::query()
    ->whereNotNull('parent_id')
    ->get();
    $service = new \App\Services\StateService();
    return $service->getAllCities();
}
