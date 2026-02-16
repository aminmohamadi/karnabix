<?php

namespace App\Http\Controllers\Site\Articles;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\WithPagination;

class IndexArticle extends BaseComponent
{
    use WithPagination;

    public array $categories = [] , $orders = [] ;
    public ?string $q = null , $category = null, $orderBy = null;
    protected $queryString = ['q','category','orderBy'];
    protected $listeners = ['load-more' => 'loadMore'];
    public $perPage = 9;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->articleRepository = app(ArticleRepositoryInterface::class);
    }

    public function search()
    {
        //
    }

    public function mount()
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').' مقلات ');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' مقلات ');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' مقلات ');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').' مقلات ');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->categories = $this->categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::ARTICLE,[['parent_id',null]]);
        $this->orders = [
            'latest' => 'جدید ترین' ,
            'oldest' => 'قدیمی ترین' ,
            'پیش فرض' => ''
        ];
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'courses' => ['link' => '' , 'label' => 'مقالات اموزشی']
        ];
    }

    public function render()
    {
        $articles = $this->articleRepository->getAllSite($this->q,$this->category,$this->orderBy);
        $articlesCount = $this->articleRepository->getAllSiteCount($this->q,$this->category,$this->orderBy);

        $hasMore = $articlesCount > $articles->count();
        return view('new.articles.index',['articles'=>$articles,'hasMore' => $hasMore])->extends('new.layouts.app');
    }
}
