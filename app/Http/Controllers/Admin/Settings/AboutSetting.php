<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class AboutSetting extends BaseComponent
{
    public  $aboutUs , $header, $footer_about;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_aboutUs');
        $this->header = 'تنظیمات درباره ما';
        $this->aboutUs = $this->settingRepository->getRow('aboutUs');
        $this->footer_about = $this->settingRepository->getRow('footer_about');
    }

    public function store()
    {

        $this->authorizing('edit_settings_aboutUs');

        $this->validate(
            [
                'aboutUs' => ['nullable', 'string','max:600000'],
                'footer_about'=>['nullable','string','max:2000']
            ] , [] , [
                'aboutUs' => 'درباره ما',
                'footer_about'=>'متن فوتر'
            ]
        );

        $this->settingRepository::updateOrCreate(['name' => 'aboutUs'], ['value' => $this->aboutUs]);
        $this->settingRepository::updateOrCreate(['name' => 'footer_about'], ['value' => strip_tags($this->footer_about)]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.settings.about-setting')
            ->extends('admin.layouts.admin');
    }
}
