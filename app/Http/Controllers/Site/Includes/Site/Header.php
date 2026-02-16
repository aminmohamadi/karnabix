<?php

namespace App\Http\Controllers\Site\Includes\Site;

use App\Enums\CategoryEnum;
use App\Helpers\Helper;
use App\Http\Controllers\BaseComponent;
use App\Http\Controllers\Cart\Facades\Cart as Carts;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class Header extends BaseComponent
{
    protected $listeners = ['cartUpdated' => 'updateCartCount'];
    public  $categories = [] , $cartContent = [] , $q;
    public $categoriesExam = [];
    protected $queryString = ['q'];


    public function mount
    (
        SettingRepositoryInterface $settingRepository ,
        CategoryRepositoryInterface $categoryRepository
    )
    {
        $this->categories = $categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]],0);
        $this->categoriesExams = $categoryRepository->getCategoriesWithTheirSubCategories(CategoryEnum::COURSE,[['parent_id',null]],1);
        $this->cartContent = Carts::count();
        $this->siteTitle = $settingRepository->getRow("name");
    }

    public function render()
    {
        return view('new.layouts.header-site');
    }

    public function search()
    {
        redirect()->route('courses',['q'=>$this->q]);
    }

    public function updateCartCount()
    {
        $this->cartContent = Carts::count();
    }
}
