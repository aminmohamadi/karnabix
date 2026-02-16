<?php

namespace App\Http\Controllers\Admin\SalePersonCheckout;

use App\Enums\CheckoutEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\SalePersonCheckoutRepository;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Livewire\WithPagination;

class IndexSalePersonCheckout extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = ' شماره درخواست یا شماره همراه مدرس';

    public $result;

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(SalePersonCheckoutRepository::class);
    }

    public function mount()
    {
        $this->authorizing('show_checkouts');
        $this->data['status'] = CheckoutEnum::getStatus();
    }

    public function render()
    {
        $checkouts = $this->checkoutRepository->getAllAdmin($this->search,$this->status,$this->per_page);
        return view('admin.saleperson-checkouts.index-teacher-checkout',['checkouts'=>$checkouts])->extends('admin.layouts.admin');
    }

}
