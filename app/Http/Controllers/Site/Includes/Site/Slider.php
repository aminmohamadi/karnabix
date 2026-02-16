<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Slider extends BaseComponent
{
    public $q;

    protected $queryString = ['q'];

    public  $slider , $sliderImage , $sliderLink , $count, $slider_title, $slider_sub_title, $slider_button_text;

    public function mount
    (
        CourseRepositoryInterface $courseRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->slider = $settingRepository->getRow('slider');
        $this->sliderImage = $settingRepository->getRow('sliderImage');
        $this->sliderLink = $settingRepository->getRow('sliderLink');
        $this->slider_title = $settingRepository->getRow('sliderTitle');
        $this->slider_sub_title = $settingRepository->getRow('sliderSubTitle');
        $this->slider_button_text = $settingRepository->getRow('sliderButtonText');
        $this->count = $courseRepository->count();
    }

    public function render()
    {
        return view('new.components.slider');
    }

    public function search()
    {
        redirect()->route('courses',['q'=>$this->q]);
    }
}
