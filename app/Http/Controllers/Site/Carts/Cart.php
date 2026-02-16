<?php

namespace App\Http\Controllers\Site\Carts;

use App\Enums\OrderEnum;
use App\Enums\PaymentEnum;
use App\Enums\ReductionEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Course;
use App\Notifications\Sms\ExamPaidSMS;
use App\Repositories\Classes\CourseRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\ReductionMetaRepositoryInterface;
use App\Repositories\Interfaces\ReductionRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Http\Controllers\Cart\Facades\Cart as Carts;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\MessageBag;
use Mockery\Exception;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class Cart extends BaseComponent
{
    public $address, $user, $phone, $name, $gateway, $gateways = [];
    public $description, $afterExamPaidSmsEnabled;
    public $useWallet = false;
    private $walletAmount = 0;
    public $useVoucher = false;
    public $voucherCode;
    private $voucherAmount = 0;

    public $voucherAmountShow = 0;
    public $walletAmountShow = 0;
    public $userWallet;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->reductionRepository = app(ReductionRepositoryInterface::class);
        $this->reductionMetaRepository = app(ReductionMetaRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->orderNoteRepository = app(OrderNoteRepositoryInterface::class);
    }

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title') . ' سبد خرید ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword', []));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title') . ' سبد خرید ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title') . ' سبد خرید ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title') . ' سبد خرید ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home'), 'label' => 'صفحه اصلی'],
            'cart' => ['link' => '', 'label' => 'سبد خرید'],
        ];
        $gateways = $this->settingRepository->getRow('gateway', []);
        foreach ($gateways as $key => $gateway) {
            if ($key == 0)
                $this->gateway = $gateway;

            $this->gateways[$gateway] = [
                'merchantId' => $this->settingRepository->getRow("{$gateway}_merchantId"),
                'title' => $this->settingRepository->getRow("{$gateway}_title"),
                'logo' => $this->settingRepository->getRow("{$gateway}_logo"),
                'sandbox' => (bool)$this->settingRepository->getRow("{$gateway}_sandbox") ?? null,
                'mode' => $this->settingRepository->getRow("{$gateway}_mode") ?? null,
                'unit' => (int)$this->settingRepository->getRow("{$gateway}_unit") ?? 1,
            ];
        }
        if (auth()->check()) {
            $this->userWallet = auth()->user()->wallet->balance;
        }

    }

    public function deleteItem($id)
    {
        Carts::delete($id);
        $this->emit('cartUpdated');
    }

    public function render()
    {
        $this->walletAmountShow = $this->walletAmount;
        $this->voucherAmountShow = $this->voucherAmount;
        $cartContent = Carts::content();
        return view('new.cart.cart', ['cartContent' => $cartContent])->extends('new.layouts.app');
    }

    public function updatedUseWallet()
    {
        $this->calculatePrice();
    }

    private function calculatePrice()
    {
        $this->walletAmount = 0;
        if ($this->useWallet) {
            $user = auth()->user();

            $balance = $user->balance;
            if ($balance > 0) {
                if ($balance >= \App\Http\Controllers\Cart\Facades\Cart::total(0, $this->voucherAmount, 0)) {
                    $balance = Carts::total(0, $this->voucherAmount, 0);
                }

                $this->walletAmount = $balance;
            }
        }
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function checkVoucherCode()
    {
        $this->useVoucher = false;
        $this->voucherAmount = 0;
        $voucher = $this->reductionRepository->get([['code', $this->voucherCode]]);

        //exists
        if (empty($voucher)) {
            $this->addError('voucher', 'کد وارد شده معتبر نیست');
            $this->calculatePrice();
            $this->voucherCode = null;
            return;
        }

        if (!empty($voucher->expires_at)) {
            $interval = Carbon::make(now())->diff($voucher->expires_at);
            if ((int)$interval->format("%r%h") < 0) {
                $this->addError('voucher', 'کد وارد شده  منقضی شده است');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }
        }

        if (!empty($voucher->starts_at)) {

            $interval = Carbon::make(now())->diff($voucher->starts_at);

            if ((int)$interval->format("%r%h") > 0) {
                $this->addError('voucher', 'کد وارد شده معتبر نیست');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }

        }

        $meta = $voucher->metas;

        if ($meta->contains('name', 'minimum_amount')) {
            if (Carts::price() < $meta->where('name', 'minimum_amount')->first()->value) {
                $this->addError('voucher', 'مبلغ سفارش کمتر از حد مجاز است');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }
        }

        if ($meta->contains('name', 'maximum_amount')) {
            if (Carts::price() > $meta->where('name', 'maximum_amount')->first()->value) {
                $this->addError('voucher', 'مبلغ سفارش بیشتر از حد مجاز است');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }
        }

        if ($meta->contains('name', 'product_ids')) {
            foreach (Carts::content() as $item) {
                if (!str_contains($meta->where('name', 'product_ids')->first()->value, $item->id)) {
                    $this->addError('voucher', 'امکان استفاده روی این محصولات وجود ندارد');
                    $this->calculatePrice();
                    $this->voucherCode = null;
                    return;
                }
            }
        }

        if ($meta->contains('name', 'exclude_product_ids')) {
            foreach (Carts::content() as $item) {
                if (str_contains($meta->where('name', 'exclude_product_ids')->first()->value, $item->id)) {
                    $this->addError('voucher', 'امکان استفاده روی این محصولات وجود ندارد');
                    $this->calculatePrice();
                    $this->voucherCode = null;
                    return;
                }
            }
        }

        if ($meta->contains('name', 'exclude_sale_items')) {
            foreach (Carts::content() as $item) {
                if ($item->discount() > 0) {
                    $this->addError('voucher', 'امکان استفاده روی محصول دارای تخفیف وجود ندارد');
                    $this->calculatePrice();
                    $this->voucherCode = null;
                    return;
                }
            }
        }

        if ($meta->contains('name', 'category_ids')) {
            foreach (Carts::content() as $item) {
                $product = $this->courseRepository->find($item->id);
                $category = $this->categoryRepository->find($product->category_id);
                $parentCategory = $category->parent;
                foreach (explode(',', $meta->where('name', 'category_ids')->first()->value) as $cat) {
                    if ((int)$cat != $category->id || (int)$cat != $parentCategory->id) {
                        $this->addError('voucher', 'امکان استفاده روی ابن محصولات وجود ندارد');
                        $this->calculatePrice();
                        $this->voucherCode = null;
                        return;
                    }
                }
            }
        }

        if ($meta->contains('name', 'exclude_category_ids')) {
            foreach (Carts::content() as $item) {
                $product = $this->courseRepository->find($item->id);
                $category = $this->categoryRepository->find($product->category_id);
                $parentCategory = $category->parent;
                foreach (explode(',', $meta->where('name', 'exclude_category_ids')->first()->value) as $cat) {
                    if ((int)$cat = $category->id || (int)$cat == $parentCategory->id) {
                        $this->addError('voucher', 'امکان استفاده روی ابن محصولات وجود ندارد');
                        $this->calculatePrice();
                        $this->voucherCode = null;
                        return;
                    }
                }
            }
        }

        if ($meta->contains('name', 'usage_limit')) {
            $count = $this->orderRepository->count([['reduction_code', $voucher->code]]);
            if ($count >= (int)$meta->where('name', 'usage_limit')->first()->value) {
                $this->addError('voucher', 'امکان استفاده از کد وجود ندارد');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }
        }

        if ($meta->contains('name', 'usage_limit_per_user')) {
            $count = $this->orderRepository->count([['reduction_code', $voucher->code], ['user_id', auth()->id()]]);
            if ($count >= (int)$meta->where('name', 'usage_limit_per_user')->first()->value) {
                $this->addError('voucher', 'شما قبلا به میزان مجاز از این کد استفاده کرده اید');
                $this->calculatePrice();
                $this->voucherCode = null;
                return;
            }
        }
        if ($meta->contains('name', 'value_limit')) {
            if ($voucher->type == ReductionEnum::PERCENT) {
                if (((Carts::total() * $voucher->amount) / 100) > $meta->where('name', 'value_limit')->first()->value) {
                    $this->useVoucher = true;

                    $this->voucherAmount = $voucher->amount;

                    $this->voucherAmount = $meta->where('name', 'value_limit')->first()->value;

                    $this->calculatePrice();

                    return;
                }
            }
        }

        $this->useVoucher = true;

        $this->voucherAmount = $voucher->amount;
        if ($voucher->type == ReductionEnum::PERCENT) {
            $this->voucherAmount = (Carts::total() * $voucher->amount) / 100;
        }

        $this->calculatePrice();
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function payment(): bool|Redirector|string|Application|RedirectResponse|MessageBag
    {
        $this->calculatePrice();
        $this->checkVoucherCode();

        $this->description = ($this->description == '') ? null : $this->description;

        if (sizeof(Carts::content()) == 0)
            return redirect()->route('home');

        $voucher = $this->reductionRepository->get([['code', $this->voucherCode]]);
        if ($this->useVoucher && empty($voucher)) {
            $this->useVoucher = false;
            $this->voucherCode = null;
            return $this->addError('voucher', 'کد وارد شده معتبر نیست');
        }

        if (Carts::total($this->walletAmount, $this->voucherAmount, 0) == 0) {
            $orderId = $this->store();
            return (gettype($orderId) == 'integer' && $orderId > 0) ?
                redirect(route('verify', ['tracking' => $orderId + $this->orderRepository::CHANGE_ID()])) : '';
        }

        $this->validate([
            'gateway' => ['required', 'in:' . implode(',', $this->settingRepository->getRow('gateway', []))]
        ], [], [
            'gateway' => 'درگاه'
        ]);

        if ($error = $this->paymentReporitory->pay(
            amount: Carts::total($this->walletAmount, $this->voucherAmount, 0) * $this->gateways[$this->gateway]['unit'],
            gateway: $this->gateway,
            config: $this->gateways[$this->gateway],
            callbackUrl: env('APP_URL') . "/verify/{$this->gateway}",
            callbackFunction: fn($gateway = null, $transactionId = null) => $this->store($gateway, $transactionId)
        )) $this->addError('gateway', $error);

        return false;
    }

    private function store($gateway = null, $transactionId = null)
    {
        $this->afterExamPaidSmsEnabled = $this->settingRepository->getRow('afterExamPaidSmsEnabled');
        return DB::transaction(function () use ($gateway, $transactionId) {
            $voucherAmount = 0;
            if ($this->useVoucher) {
                $voucherCode = $this->voucherCode;
                $voucherAmount = $this->voucherAmount;
            }
            try {
                DB::beginTransaction();
                $orderRepository = $this->orderRepository->create([
                    'user_id' => auth()->id(),
                    'user_ip' => request()->ip(),
                    'price' => Carts::price(),
                    'total_price' => Carts::total($this->walletAmount, $voucherAmount, 0),
                    'reduction_code' => $voucherCode ?? null,
                    'reductions_value' => Carts::discount() + $voucherAmount,
                    'wallet_pay' => $this->walletAmount,
                    'discount' => Carts::discount(),
                    'transactionId' => $transactionId,
                ]);

                if (!is_null($gateway)) {
                    $this->paymentReporitory->create(auth()->user(), [
                        'amount' => Carts::total($this->walletAmount, $voucherAmount, 0),
                        'payment_gateway' => $gateway,
                        'payment_token' => $transactionId,
                        'model_type' => PaymentEnum::order(),
                        'model_id' => $orderRepository->id,
                        'call_back_url' => '',
                        'ip' => request()->ip()
                    ]);
                }
                $original_cart_total_price = Carts::total(0, 0, 0);
                foreach (Carts::content() as $key => $item) {
                    if ($this->afterExamPaidSmsEnabled == 1) {
                        $course = Course::find($key);
                        if ($course->only_exam == 1) {
                            Notification::send(auth()->user(), new ExamPaidSMS($course));
                        }
                    }


                    $singe_total_price = $item->total();
                    $singe_voucher_amount = 0;
                    $singe_wallet_amount = 0;

                    if ($voucherAmount > 0) {
                        $cart_total_price = Carts::total(0, $voucherAmount, 0);
                        $total_voucher_percent = (($original_cart_total_price - $cart_total_price) / $original_cart_total_price);

                        $singe_voucher_amount = $singe_total_price * $total_voucher_percent;
                    }

                    if ($this->walletAmount > 0) {
                        $cart_total_price = Carts::total($this->walletAmount, 0, 0);
                        $total_wallet_percent = (($original_cart_total_price - $cart_total_price) / $original_cart_total_price);
                        $singe_wallet_amount = $singe_total_price * $total_wallet_percent;
                    }
                    $this->orderDetailRepository->create([
                        'course_id' => $key,
                        'product_data' => json_encode(['id' => $item->id, 'title' => $item->title]),
                        'price' => ($item->basePrice),
                        'total_price' => abs($singe_total_price - $singe_voucher_amount - $singe_wallet_amount),
                        'reduction_amount' => max($singe_voucher_amount + $item->discount(), 0),
                        'wallet_amount' => max($singe_wallet_amount, 0),
                        'status' => OrderEnum::STATUS_NOT_PAID,
                        'quantity' => 1,
                        'order_id' => $orderRepository->id,
                    ]);
                }
                $this->orderNoteRepository->create([
                    'note' => 'سفارش ' . $orderRepository->tracking_code . ' باموفقیت ثبت شد',
                    'is_user_note' => 1,
                    'is_read' => 0,
                    'order_id' => $orderRepository->id,
                ]);
                if (auth()->user()->referrer) {
                    $user_percent = auth()->user()->referrer->roles()->first() != null ? auth()->user()->referrer->roles()->first()->percent : $this->settingRepository->getRow("normalUsersCommission");
                    $commission = Carts::price() * $user_percent / 100;
                    auth()->user()->referrer->wallet->balance += $commission;
                    auth()->user()->referrer->wallet->save();
                }

                DB::commit();
                


            } catch (Exception $e) {
                DB::rollBack();
                $this->emitNotify('خطا در هنگام پرداخت', 'warning');
            }
            return $orderRepository->id ?? 0;
        });

    }
}
