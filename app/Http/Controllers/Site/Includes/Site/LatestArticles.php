<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\ArticleRepository;
use App\Repositories\Classes\ExamRepository;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class LatestArticles extends BaseComponent
{

    public  $articles;

    public function mount
    (
        ArticleRepository $articleRepository,
        SettingRepositoryInterface $settingRepository
    )
    {
        $this->articles = $articleRepository->latest();
    }

    public function render()
    {
        return view('new.components.latest-articles');
    }


}
