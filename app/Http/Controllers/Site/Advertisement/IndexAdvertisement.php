<?php

namespace App\Http\Controllers\Site\Advertisement;
use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Advertise;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexAdvertisement extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['q','category','type','orderBy','teacher','property'];
    public ?string $q = null , $category = null  , $orderBy = null , $type = null , $property = null , $teacher =null;
    public array $categories = [] , $types = [] , $orders = [] , $remote = [];
    public $perPage = 1;
    protected $listeners = ['load-more' => 'loadMore'];
    public function mount(
        SettingRepositoryInterface $settingRepository,
    )
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' آگهی های استخدام ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' آگهی های استخدام ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' آگهی های استخدام ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' آگهی های استخدام ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));


        $this->orders = [
            'latest' => 'جدید ترین' ,
            'oldest' => 'قدیمی ترین' ,
        ];
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'دوره های اموزشی']
        ];
        $this->types = config('jobs.jobs.types');
        $this->remote = config('jobs.jobs.remote');
        $this->categories = config('jobs.jobs.categories');
    }

    public function render(AdvertiseRepository $advertiseRepository)
    {
        $advertises =  $advertiseRepository->getAllSite($search = $this->q, $orderBy = $this->orderBy, $type = $this->type, $category = $this->category, $status = null, $count = $this->perPage, $where = [['status',1]]);
        $advertisesCount =  $advertiseRepository->getAllSiteCount($search = $this->q, $orderBy = $this->orderBy, $type = $this->type, $category = $this->category, $status = null, $count = $this->perPage, $where = [['status',1]]);
        $hasMore = $advertisesCount > $advertises->count();
        return view('new.advertises.index',['advertises' => $advertises,'hasMore' => $hasMore])->extends('new.layouts.app');
    }
    public function loadMore()
    {
        $this->perPage += 9;
    }
}
