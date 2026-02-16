<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class LatestCourse extends BaseComponent
{
    public $q;

    protected $queryString = ['q'];

    public  $courses;

    public function mount
    (
        CourseRepositoryInterface $courseRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->courses = $courseRepository->latest();
    }

    public function render()
    {
        return view('new.components.course-slider');
    }


}
