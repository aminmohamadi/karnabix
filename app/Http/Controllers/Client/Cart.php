<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Models\User;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class Cart extends BaseComponent
{
    protected $settingRepository;
    public $user, $ref, $amount, $receiver;
    protected $listeners = ['finish' => 'finish'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($action, $id = null)
    {

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

        return view('site.client.cart')->extends('site.layouts.client.client');
    }

    public function store()
    {
        $fields = [
            'ref' => [
                'required',
                Rule::exists('users', 'referral_code'),
                function ($attribute, $value, $fail) {
                    if (auth()->check() && $value === auth()->user()->referral_code) {
                        $fail('شما نمی‌توانید کد خودتان را وارد کنید.');
                    }
                }
            ],
            'amount' => ['required', 'numeric', 'between:5000,' . Auth::user()->wallet->balance],

        ];
        $messages = [
            'ref' => 'کد کاربر',
            'amount' => 'مبلغ',
        ];
        $this->validate($fields, [], $messages);
        $this->receiver = User::where('referral_code', $this->ref)->first();
        $name = $this->receiver->name;
        $title = "واربز وجه؟";
        $x = number_format($this->amount);
        $message = "انتقال مبلغ $x تومان به کیف پول $name ";
        $this->showModal($title, $message);
    }

 public function finish()
    {
        $sender = $this->user;
        $sender->forceWithdraw($this->amount,['description' => 'بابت انتقال وجه به حساب  ' . $this->receiver->phone]);
        $this->receiver->deposit($this->amount,['description' => 'بابت انتقال وجه از حساب  ' . $sender->phone]);
        $this->emitNotify('انتقال وجه با موفقیت انجام شد.', 'success');
        return redirect()->route('user.carts');
    }


    public function showModal($title, $message)
    {
        $data['title'] = $title;
        $data['message'] = $message;
        $this->emit('showModal', $data);
    }


}
