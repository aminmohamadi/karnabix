<?php

namespace App\Http\Controllers\SalePerson\Dashboards;

use App\Http\Controllers\BaseComponent;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Role;
use App\Models\User;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class Dashboard extends BaseComponent
{
    public $box = [] , $from_date , $to_date;

    public $to_date_viwe , $from_date_view , $user_refferals, $sales_count,$totalReferralPurchases, $earning,$user_wallet;
    protected $queryString = ['from_date','to_date'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount()
    {
        $user = auth()->user();

        $this->user_refferals = $user->referrals()->count();
        $referralIds = User::where('referrer_id', $user->id)->pluck('id');

        $this->totalReferralPurchases = OrderDetail::whereIn('order_id', function($query) use ($referralIds) {
            $query->select('id')
                ->from('orders')
                ->whereIn('user_id', $referralIds);
        })->count();
        $this->earning = OrderDetail::whereIn('order_id', function($query) use ($referralIds) {
            $query->select('id')
                ->from('orders')
                ->whereIn('user_id', $referralIds);
        })->sum('price') * (Role::findByName('sale')->percent / 100);

        $this->user_wallet = $user->wallet->balance;
    }




    public function render()
    {
        return view('salePerson.dashboards.dashboard')->extends('salePerson.layouts.salePerson');
    }
}
