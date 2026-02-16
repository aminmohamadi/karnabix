<?php

namespace App\Http\Controllers\SalePerson\Checkouts;

use App\Enums\CheckoutEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\SalePersonCheckoutRepository;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Livewire\WithPagination;

class IndexCheckout extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'شماره درخواست';

    public $result;

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(SalePersonCheckoutRepository::class);
    }

    public function mount()
    {
        $this->data['status'] = CheckoutEnum::getStatus();
    }

    public function render()
    {
        $checkouts = $this->checkoutRepository->getAllSalePerson($this->search,$this->status,$this->per_page);
        return view('salePerson.checkouts.index-checkout',['checkouts'=>$checkouts])->extends('salePerson.layouts.salePerson');
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = auth()->user()->salePersonCheckout->filter(function ($v,$k) use ($key){
            return $v['id'] == $key;
        })->first()->result;
    }
}
