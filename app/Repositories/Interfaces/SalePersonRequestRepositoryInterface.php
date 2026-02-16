<?php

namespace App\Repositories\Interfaces;

use App\Models\SalePersonRequest;

interface SalePersonRequestRepositoryInterface
{
    public function newApply(array $data);

    public static function getNew();

    public function getAllAdmin($search , $status , $per_page);

    public function destroy($id);

    public function findOrFail($id);

    public function save(SalePersonRequest $salePersonRequest): SalePersonRequest;
}
