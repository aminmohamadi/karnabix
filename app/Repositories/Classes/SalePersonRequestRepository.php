<?php

namespace App\Repositories\Classes;

use App\Enums\TeacherEnum;
use App\Models\SalePersonRequest;
use App\Models\TeacherRequest;
use App\Repositories\Interfaces\SalePersonRequestRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;

class SalePersonRequestRepository implements SalePersonRequestRepositoryInterface
{

    public function newApply(array $data)
    {
        return SalePersonRequest::create($data);
    }

    public static function getNew()
    {
        return SalePersonRequest::where('status',TeacherEnum::APPLY_PENDING)->count();
    }

    public function getAllAdmin($search, $status, $per_page)
    {
        return SalePersonRequest::latest('id')->with('user')->when($search , function ($q) use ($search){
            return $q->whereHas('user',function ($q) use ($search){
                return $q->where('phone','LIKE','%'.$search.'%');
            });
        })->when($status,function ($q) use ($status){
            return $q->where('status',$status);
        })->paginate($per_page);
    }

    public function destroy($id): int
    {
        return SalePersonRequest::destroy($id);
    }

    public function findOrFail($id)
    {
        return SalePersonRequest::findOrFail($id);
    }

    public function save(SalePersonRequest $salePersonRequest): SalePersonRequest
    {
        $salePersonRequest->save();
        return $salePersonRequest;
    }
}
