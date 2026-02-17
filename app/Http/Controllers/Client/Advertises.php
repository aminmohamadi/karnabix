<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\StorageEnum;
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

class Advertises extends Component
{

    public mixed $user;
    public bool $userDetails = false;
    public $company  , $job , $province , $city , $job_type , $insurance , $soldier , $salary , $content ;
    public $data;
    /**
     * @var SettingRepositoryInterface|(SettingRepositoryInterface&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $settingRepository;
    /**
     * @var PaymentRepositoryInterface|(PaymentRepositoryInterface&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $paymentReporitory;
    /**
     * @var UserRepositoryInterface|(UserRepositoryInterface&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $userRepository;
    /**
     * @var TeacherRepositoryInterface|(TeacherRepositoryInterface&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $teacherRepository;
    /**
     * @var UserDetailRepositoryInterface|(UserDetailRepositoryInterface&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $userDetailRepository;
    private \Illuminate\Contracts\Filesystem\Filesystem $disk;
    /**
     * @var AdvertiseRepository|(AdvertiseRepository&\Illuminate\Contracts\Foundation\Application)|\Illuminate\Contracts\Foundation\Application|mixed
     */
    private mixed $advertiseRepository;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->userDetailRepository = app(UserDetailRepositoryInterface::class);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->advertiseRepository = app(AdvertiseRepository::class);
        $this->disk = getDisk(StorageEnum::PUBLIC);
    }
    public function mount(){
        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.' آگهی استخدام');
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
        $this->user = auth()->user();

        $this->data['province'] = $this->settingRepository::getProvince();
    }
    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && in_array($this->province,array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);
        $myAds = auth()->user()->advertises()->get();
        return view('site.client.advertises',compact('myAds'))->extends('site.layouts.client.client');
    }

    public function storeDetails()
    {
        $fields = [
            'company' => ['required', 'string','max:150'],
            'job' => ['required', 'string','max:150'],
            'province' => ['required', 'string','max:150'],
            'city' => ['required', 'string','max:150'],
            'job_type' => ['required'],
            'insurance' => ['required'],
            'soldier' => ['required'],
            'salary' => ['required'],
            'content' => ['required'],
        ];
        $messages = [
            'company' => 'شرکت',
            'job' => 'عنوان شغلی',
            'province' => 'استان',
            'city' => 'شهر',
            'job_type' => 'نوع شغل',
            'insurance' => 'نوع بیمه',
            'soldier' => 'خدمت سربازی',
            'salary' => 'حقوق',
            'content' => 'متن',
        ];

        $this->validate($fields,[],$messages);

        \App\Models\Advertise::create([
            'company' => $this->company,
            'job' => $this->job,
            'province' => $this->province,
            'city' => $this->city,
            'job_type' => $this->job_type,
            'insurance' => $this->insurance,
            'soldier' => $this->soldier,
            'salary' => $this->salary,
            'content' => $this->content,
        ]);
        $this->reset([
            'company',
            'job',
            'province',
            'city',
            'job_type',
            'soldier',
            'salary',
            'insurance',
            'content',
            ]);
        $this->dispatchBrowserEvent('notify', ['message' => 'اطلاعات با موفقیت ثبت شد']);
    }

    public function delete($id)
    {

        $article = $this->advertiseRepository->find($id,false);
        $this->advertiseRepository->delete($article);
    }
}
