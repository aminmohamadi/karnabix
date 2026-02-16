<?php

namespace App\Http\Controllers\Site\Exams;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Course;
use App\Repositories\Classes\ExamRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExamRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexExams extends BaseComponent
{

    use WithPagination;
    protected $queryString = ['q','category','type','orderBy','teacher','property'];
    public ?string $q = null , $category = null  , $orderBy = null , $type = null , $property = null , $teacher =null;
    public array $categories = [] , $types = [] , $orders = [] ;
    public $perPage = 9;
    protected $listeners = ['load-more' => 'loadMore'];
    public function mount(
        CategoryRepositoryInterface $categoryRepository ,
        SettingRepositoryInterface $settingRepository,
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' دوره های اموزشی ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

        $this->categories = $categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]]);
        $this->types = ['free' => 'رایگان' , 'cash' => 'نقدی'];
        $this->data['types'] = CourseEnum::getTypes();
        $this->orders = [
            'latest' => 'جدید ترین' ,
            'oldest' => 'قدیمی ترین' ,
            'expensive' => 'گران ترین',
            'inexpensive' => 'ارزان ترین',
        ];
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'دوره های اموزشی']
        ];
    }

    public function render(ExamRepository $examRepository)
    {
        $courses = $examRepository->getAllSite($this->q ,$this->orderBy ,$this->type ,$this->category, $this->teacher,$this->property,$this->perPage);
        $coursesCount = $examRepository->getAllSiteCount($this->q ,$this->orderBy ,$this->type ,$this->category, $this->teacher,$this->property,$this->perPage);

        $hasMore = $coursesCount > $courses->count();

        return view('new.exams.index',['courses' => $courses,'hasMore' => $hasMore])->extends('new.layouts.app');
    }

    public function loadMore()
    {
        $this->perPage += 9;
    }
}
