<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;
use Livewire\WithFileUploads;

class Carts extends BaseComponent
{
    use WithFileUploads;
    protected $settingRepository;
    public $user, $tab;
    protected $queryString = ['tab'];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        if (!request()->exists('tab'))
            $this->tab = 'deposits';
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword', []));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title') . '-' . ' پروفایل');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title') . '-' . ' پروفایل');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title') . '-' . ' پروفایل');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->user = auth()->user();

    }

    public function render()
    {

        return view('site.client.carts')->extends('site.layouts.client.client');
    }

}
