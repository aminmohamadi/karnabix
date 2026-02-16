<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\ExamRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class LatestExam extends BaseComponent
{

    public  $exam;

    public function mount
    (
        ExamRepository $examRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->exam = $examRepository->latest();
    }

    public function render()
    {
        return view('new.components.exam-slider');
    }


}
