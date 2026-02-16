<?php

namespace App\Http\Controllers\Admin\Advertises;

use App\Enums\ArticleEnum;
use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use Livewire\WithFileUploads;

class StoreAdvertise extends BaseComponent
{
    use WithFileUploads;
    public $company ,$job, $province, $city,$job_type, $insurance, $soldier, $salary ,$content,
        $resume, $skills,$gender,$status,$title,
        $category  , $image, $validity , $remote,$file;

    public $advertise, $categories,$job_types,$insurances, $soldiers, $genders,$resumes,$remotes;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->advertiseRepository = app(AdvertiseRepository::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);

    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_articles');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->header = 'آگهی جدید';
            $this->advertise = $this->advertiseRepository->find($id);
            $this->company = $this->advertise->company;
            $this->job = $this->advertise->job;
            $this->province = $this->advertise->province;
            $this->city = $this->advertise->city;
            $this->job_type = $this->advertise->job_type;
            $this->insurance = $this->advertise->insurance;
            $this->soldier = $this->advertise->soldier;
            $this->salary = $this->advertise->salary;
            $this->content = $this->advertise->content;
            $this->resume = $this->advertise->resume;
            $this->skills = $this->advertise->skills;
            $this->gender = $this->advertise->gender;
            $this->status = $this->advertise->status;
            $this->title = $this->advertise->title;
            $this->category = $this->advertise->category;
            $this->image = $this->advertise->image;
            $this->validity = $this->advertise->validity;
            $this->remote = $this->advertise->remote;

        } elseif ($this->mode == self::CREATE_MODE) {

        } else abort(404);


        $this->data['province'] = $this->settingRepository::getProvince();
        $this->categories = config('jobs.jobs.categories');
        $this->job_types = config('jobs.jobs.types');
        $this->insurances = config('jobs.jobs.insurance');
        $this->soldiers = config('jobs.jobs.soldier');
        $this->resumes = config('jobs.jobs.resume');
        $this->genders = config('jobs.jobs.genders');
        $this->remotes = config('jobs.jobs.remote');

    }
    public function render()
    {
        $this->data['city'] = [];
        if (isset($this->province) && in_array($this->province, array_keys($this->data['province'])))
            $this->data['city'] = $this->settingRepository::getCity($this->province);
        return view('admin.advertises.store-advertise',['max_file_size' => !empty($this->settingRepository->getRow('max_profile_image_size')) ? $this->settingRepository->getRow('max_profile_image_size')  : 2048])->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->advertiseRepository->delete($this->advertise);
        return redirect()->route('admin.advertise');
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->advertise);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase( $this->advertiseRepository->getNewObject());
            $this->reset([
                'company','job','category','province','city','job_type','insurance','soldier',
                'salary','content','category','gender','resume','skills','remote','title',
            ]);        }
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
        $model->status = $this->status;
        $model->save();
        $this->reset([
            'company','job','category','province','city','job_type','insurance','soldier',
            'salary','content','category','gender','resume','skills','remote','title',
        ]);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

}
