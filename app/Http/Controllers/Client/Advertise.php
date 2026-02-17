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

class Advertise extends BaseComponent
{
    use WithFileUploads;
    public mixed $user;
    public bool $userDetails = false;
    public $image, $file,$title,$validity,$remote, $company, $job, $province, $city,$slug, $job_type, $insurance, $soldier, $salary, $content, $category, $skills, $gender, $resume;
    protected  $advertiseRepository;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->advertiseRepository = app(AdvertiseRepository::class);
        $this->disk = getDisk(StorageEnum::PUBLIC);
    }

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        SEOMeta::setTitle($this->settingRepository->getRow('title') . '-' . ' آگهی استخدام');
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
        if ($this->mode == self::UPDATE_MODE) {
            $this->advertise = $this->advertiseRepository->find($id,false);
            $this->company = $this->advertise->company;
            $this->job = $this->advertise->job;
            $this->province = $this->advertise->province;
            $this->city = $this->advertise->city;
            $this->job_type = $this->advertise->job_type;
            $this->insurance = $this->advertise->insurance;
            $this->soldier = $this->advertise->soldier;
            $this->salary = $this->advertise->salary;
            $this->content = $this->advertise->content;
            $this->category = $this->advertise->category;
            $this->resume = $this->advertise->resume;
            $this->skills = $this->advertise->skills;
            $this->gender = $this->advertise->gender;
            $this->remote = $this->advertise->remote;
            $this->title = $this->advertise->title;
            $this->validity = $this->advertise->validity;
            $this->image = $this->advertise->image;

        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'آگهی جدید';
        } else abort(404);
        $this->data['province'] = $this->settingRepository::getProvince();
    }

    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && in_array($this->province, array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);
        $myAds = auth()->user()->advertises();

        return view('site.client.advertise', ['myAds'=>$myAds,'max_file_size' => !empty($this->settingRepository->getRow('max_profile_image_size')) ? $this->settingRepository->getRow('max_profile_image_size')  : 2048])->extends('site.layouts.client.client');
    }

    public function store()
    {
//        dd($this->validity);

        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->advertise);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase( $this->advertiseRepository->getNewObject());

        }
    }
    public function uploadFile()
    {

    }
    public function saveInDateBase($model)
    {

        $fields = [
            'title'=>['required'],
            'company' => ['required', 'string', 'max:150'],
            'job' => ['required', 'string', 'max:150'],
            'category' => ['required'],
            'province' => ['required', 'string', 'max:150'],
            'city' => ['required', 'string', 'max:150'],
            'job_type' => ['required'],
            'insurance' => ['required'],
            'soldier' => ['required'],
            'gender' => ['required'],
            'resume' => ['required'],
            'skills' => ['required'],
            'salary' => ['required'],
            'content' => ['required'],
            'validity'=>['required'],
            'remote'=>['required']

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
            'category' => 'دسته بندی',
            'gender' => 'جنسییت',
            'skills' => 'مهارت ها',
            'resume' => 'سابقه کار',
            'validity' => 'تاریخ اعتبار',
            'title' => 'عنوان آگهی',
            'remote'=>'نوع حضور'


        ];
        $this->validate($fields, [], $messages);
        $this->uploadFile();
        if (!is_null($this->file)) {
            $oldFile = str_replace('storage','',$model->image);
            if (!is_null($model->image) && $this->disk->exists($oldFile))
                $this->disk->delete($oldFile);

            $model->image = 'storage/'.$this->disk->put('advertise',$this->file);
            unset($this->file);
        }
        $model->company = $this->company;
        $model->title = $this->title;
        $model->remote = $this->remote;
        $model->job = $this->job;
        $model->province = $this->province;
        $model->city = $this->city;
        $model->job_type = $this->job_type;
        $model->insurance = $this->insurance;
        $model->soldier = $this->soldier;
        $model->salary = $this->salary;
        $model->content = $this->content;
        $model->category = $this->category;
        $model->resume = $this->resume;
        $model->skills = $this->skills;
        $model->gender = $this->gender;
        $model->validity = $this->validity;
        $model->user_id = auth()->id();
        $model->status = 0;
        $model->save();
        $this->reset([
            'company','job','category','province','city','job_type','insurance','soldier',
            'salary','content','category','gender','resume','skills','remote','title',
        ]);


        $this->emitNotify('با موفقیت ثبت شد');

        return redirect()->intended(route('user.advertises'));



    }


}
