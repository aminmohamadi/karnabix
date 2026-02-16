<?php

namespace App\Http\Controllers\Site\Includes\Site;

use Livewire\Component;
use App\Http\Controllers\Cart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class Carts extends Component
{
    public $voucherCode;
    public $userWallet;
    public $cartContent = [];

    public $selectedItemId;

    public function mount()
    {
        $this->cartContent = Cart::content();
        $this->userWallet = Auth::user()->wallet ?? 0;
    }

    public function deleteItem($id)
    {
        Cart::remove($id);
        $this->cartContent = Cart::content();
        $this->dispatchBrowserEvent('item-removed');
    }

    public function checkVoucherCode()
    {
        if ($this->voucherCode === 'AMIN50') {
            session()->flash('message', 'کد تخفیف با موفقیت اعمال شد.');
            // اعمال تخفیف واقعی باید پیاده‌سازی شود
        } else {
            $this->addError('voucher', 'کد تخفیف نامعتبر است.');
        }
    }

    public function render()
    {
        return view('new.components.cart');
    }
}
