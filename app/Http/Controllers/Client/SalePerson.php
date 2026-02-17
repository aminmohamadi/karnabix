<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\StorageEnum;
use App\Enums\TeacherEnum;
use App\Http\Controllers\BaseComponent;
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

class SalePerson extends BaseComponent
{

    public mixed $user,$descriptions;
    public bool $userDetails = false;
    public $sub_title  , $body ;

    public function __construct($id = null)
    {

        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->userDetailRepository = app(UserDetailRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->user = auth()->user();
        $this->disk = getDisk(StorageEnum::PUBLIC);


    }
    public function mount(){
        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.'مشارکت در فروش');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'-'.' پروفایل');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));


        $this->data['province'] = $this->settingRepository::getProvince();

    }
    public function render()
    {

        return view('site.client.salePerson')->extends('site.layouts.client.client');
    }

    public function storeDetails()
    {
        $fields = [
            'sub_title' => ['required', 'string','max:150'],
            'descriptions' => ['required', 'string','max:150'],

        ];
        $messages = [
            'descriptions' => 'شرح درخواست',
        ];
        $this->validate($fields,[],$messages);
        auth()->user()->salePersonRequest()->create([
            'descriptions' => $this->body,
            'status' => TeacherEnum::APPLY_PENDING
        ]);

        $this->emitNotify('با موفقیت ثبت شد');

        return redirect()->intended(route('user.requests'));
    }
}
