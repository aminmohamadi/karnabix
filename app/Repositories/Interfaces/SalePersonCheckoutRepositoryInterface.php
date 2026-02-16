<?php

namespace App\Repositories\Interfaces;


use App\Models\SalePersonCheckout;

interface SalePersonCheckoutRepositoryInterface
{
    public function getAllAdmin($search , $status , $per_page);

    public function destroy($id);

    public function save(SalePersonCheckout $checkout);

    public function getAllSalePerson($search,$status , $per_page);

    public function getNewObject();

    public static function getNew();

    public function findOrFail($id , $where = []);


}
