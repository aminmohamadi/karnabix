<?php

namespace App\Http\Controllers\Site\Advertisement;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class SingleAdvertisement extends BaseComponent
{
    public $city, $province,  $related_posts , $comments , $recaptcha , $commentCount = 10 ,  $actionComment  , $actionLabel = 'دیدگاه جدید' ;
    public ?string $comment = null;
    public object $advertise;

    public ?string $q = null;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->advertiseRepository = app(AdvertiseRepository::class);
    }


    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function mount($id)
    {

        $this->advertise = $this->advertiseRepository->get([['id',$id]],true);
        SEOMeta::setTitle("آگهی استخدام ". $this->advertise->job);
        SEOMeta::setDescription($this->advertise->job);
//        SEOMeta::addKeyword($this->article->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->advertise->job);
        OpenGraph::setDescription($this->advertise->job);
        TwitterCard::setTitle($this->advertise->job);
        TwitterCard::setDescription($this->advertise->job);
        JsonLd::setTitle($this->advertise->job);
        JsonLd::setDescription($this->advertise->job);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'articles' => ['link' => route('articles') , 'label' => 'آگهی های استخدام'],
            'article' => ['link' => '' , 'label' => $this->advertise->title],
        ];
        $this->related_posts = $this->advertiseRepository->whereIn('category',[$this->advertise->category]);
        $this->province = $this->settingRepository::getProvince()[$this->advertise->province];
        $this->city = $this->settingRepository::getCities()[$this->advertise->province][$this->advertise->city];

    }
    public function render()
    {
        return view('new.advertises.single')->extends('new.layouts.app');
    }
}
