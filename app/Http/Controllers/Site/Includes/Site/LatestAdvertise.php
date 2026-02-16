<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class LatestAdvertise extends BaseComponent
{


    public  $advertise;

    public function mount
    (
        AdvertiseRepository $advertiseRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->advertise = $advertiseRepository->latest();
    }

    public function render()
    {
        return view('new.components.advertise-slider');
    }


}
