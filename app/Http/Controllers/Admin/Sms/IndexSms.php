<?php

namespace App\Http\Controllers\Admin\Sms;

use App\Enums\TicketEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\SettingRepository;
use Livewire\WithPagination;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;

class IndexSms extends BaseComponent
{
    public
        $smsPanelUsername, $smsPanelPassword, $smsPanelFrom,
        $userVerifyPatternEnabled, $userVerifyPattern,
        $afterExamPaidSmsEnabled, $afterExamPaidVoucherPattern, $afterExamPaidVoucherPercentage, $afterExamPaidVoucherCode,
        $afterExamRejectedSmsEnabled, $afterExamRejectedVoucherPattern, $afterExamRejectedVoucherPercentage, $afterExamRejectedVoucherCode,
        $userWalletBalanceIncreasedSmsEnabled, $userWalletBalanceDecreasedSmsEnabled,
        $userWalletIncreasedSmsPattern, $userWalletDecreasedSmsPattern,



        $siteTitle;
    protected $settingRepository;

    public function __construct($id = null)
    {
        $this->settingRepository = app(SettingRepositoryInterface::class);;
    }

    public function mount()
    {
        $this->authorize('show_settings_sms_ads');

        $this->smsPanelUsername = $this->settingRepository->getRow('smsPanelUsername');
        $this->smsPanelPassword = $this->settingRepository->getRow('smsPanelPassword');
        $this->smsPanelFrom = $this->settingRepository->getRow('smsPanelFrom');


        $this->userVerifyPatternEnabled = $this->settingRepository->getRow('userVerifyPatterEnabled');
        $this->userVerifyPattern = $this->settingRepository->getRow('userVerifyPattern');


        $this->afterExamPaidSmsEnabled = $this->settingRepository->getRow('afterExamPaidSmsEnabled');
        $this->afterExamPaidVoucherPattern = $this->settingRepository->getRow('afterExamPaidVoucherPattern');
        $this->afterExamPaidVoucherPercentage = $this->settingRepository->getRow('afterExamPaidVoucherPercentage');
        $this->afterExamPaidVoucherCode = $this->settingRepository->getRow('afterExamPaidVoucherCode');



        $this->afterExamRejectedSmsEnabled = $this->settingRepository->getRow('afterExamRejectedSmsEnabled');
        $this->afterExamRejectedVoucherPattern = $this->settingRepository->getRow('afterExamRejectedVoucherPattern');
        $this->afterExamRejectedVoucherPercentage = $this->settingRepository->getRow('afterExamRejectedVoucherPercentage');
        $this->afterExamRejectedVoucherCode = $this->settingRepository->getRow('afterExamRejectedVoucherCode');


        $this->userWalletBalanceDecreasedSmsEnabled = $this->settingRepository->getRow('userWalletBalanceDecreasedSmsEnabled');
        $this->userWalletBalanceIncreasedSmsEnabled = $this->settingRepository->getRow('userWalletBalanceIncreasedSmsEnabled');
        $this->userWalletDecreasedSmsPattern = $this->settingRepository->getRow('userWalletDecreasedSmsPattern');
        $this->userWalletIncreasedSmsPattern = $this->settingRepository->getRow('userWalletIncreasedSmsPattern');

        $this->siteTitle = $this->settingRepository->getRow('title');

    }

    public function render()
    {
        return view('admin.sms.index')->extends('admin.layouts.admin');
    }


    public function store()
    {
        $this->authorize('edit_settings_sms_ads');
        $this->validate([
            'afterExamPaidVoucherCode' => ['nullable', 'exists:reductions,code'],
            'afterExamRejectedVoucherCode' => ['nullable', 'exists:reductions,code'],
            'smsPanelUsername' => ['required'],
            'smsPanelPassword' => ['required'],
            'smsPanelFrom' => ['required'],
        ], [], [
            'afterExamPaidVoucherCode' => 'کد تخفیف آزمون',
            'afterExamRejectedVoucherCode' => 'کد تخفیف آزمون',
            'smsPanelUsername' => 'نام کاربری پنل پیامکی',
            'smsPanelPassword' => 'رمز عبور پنل پیامکی',
            'smsPanelFrom' => 'سرشماره ارسال پیامک',
        ]);

        $this->settingRepository::updateOrCreate(['name' => 'smsPanelUsername'], ['value' => $this->smsPanelUsername]);
        $this->settingRepository::updateOrCreate(['name' => 'smsPanelPassword'], ['value' => $this->smsPanelPassword]);
        $this->settingRepository::updateOrCreate(['name' => 'smsPanelFrom'], ['value' => $this->smsPanelFrom]);

        $this->settingRepository::updateOrCreate(['name' => 'userVerifyPatterEnabled'], ['value' => $this->userVerifyPatternEnabled ? 1 : 0]);
        $this->settingRepository::updateOrCreate(['name' => 'userVerifyPattern'], ['value' => $this->userVerifyPattern]);

        $this->settingRepository::updateOrCreate(['name' => 'afterExamPaidSmsEnabled'], ['value' => $this->afterExamPaidSmsEnabled ? 1 : 0]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamPaidVoucherPattern'], ['value' => $this->afterExamPaidVoucherPattern]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamPaidVoucherPercentage'], ['value' => $this->afterExamPaidVoucherPercentage]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamPaidVoucherCode'], ['value' => $this->afterExamPaidVoucherCode]);



        $this->settingRepository::updateOrCreate(['name' => 'afterExamRejectedSmsEnabled'], ['value' => $this->afterExamRejectedSmsEnabled ? 1 : 0]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamRejectedVoucherPattern'], ['value' => $this->afterExamRejectedVoucherPattern]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamRejectedVoucherPercentage'], ['value' => $this->afterExamRejectedVoucherPercentage]);
        $this->settingRepository::updateOrCreate(['name' => 'afterExamRejectedVoucherCode'], ['value' => $this->afterExamRejectedVoucherCode]);
        $this->settingRepository::updateOrCreate(['name' => 'userWalletBalanceDecreasedSmsEnabled'], ['value' => $this->userWalletBalanceDecreasedSmsEnabled ? 1 : 0]);
        $this->settingRepository::updateOrCreate(['name' => 'userWalletBalanceIncreasedSmsEnabled'], ['value' => $this->userWalletBalanceIncreasedSmsEnabled ? 1 : 0]);
        $this->settingRepository::updateOrCreate(['name' => 'userWalletDecreasedSmsPattern'], ['value' => $this->userWalletDecreasedSmsPattern]);
        $this->settingRepository::updateOrCreate(['name' => 'userWalletIncreasedSmsPattern'], ['value' => $this->userWalletIncreasedSmsPattern]);

        $this->emitNotify('اطلاعات پنل پیامکی با موفقیت ذخیره شد', 'success');
    }

}
