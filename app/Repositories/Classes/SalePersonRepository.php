<?php


namespace App\Repositories\Classes;

use App\Models\SalePerson;
use App\Models\Teacher;
use App\Repositories\Interfaces\SalePersonRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;

class SalePersonRepository implements SalePersonRepositoryInterface
{
    public function getAllAdmin($search, $per_page , $panel_status = false)
    {
        return SalePerson::with('user')->when($panel_status,function ($q){
            return $q->where('panel_status',true);
        })->when($search,function ($q) use ($search){
            return $q->whereHas('user',function ($q) use ($search){
                return is_numeric($search) ? $q->where('phone',$search) : $q->where('name',$search);
            });
        })->paginate($per_page);
    }

    public function find($id)
    {
        return SalePerson::findOrFail($id);
    }

    public function destroy($id)
    {
        return SalePerson::destroy($id);
    }

    public function newTeacherObject()
    {
        return new SalePerson();
    }

    public function save(SalePerson $salePerson)
    {
        $salePerson->save();
        return $salePerson;
    }

    public function getAll(): \Illuminate\Database\Eloquent\Collection
    {
        return SalePerson::all();
    }

    public function count()
    {
        return SalePerson::count();
    }

    public function updateOrCreate(array $key, array $value)
    {
        SalePerson::withTrashed()->updateOrCreate($key,$value);
    }

    public function delete($user_id)
    {
        $teacher = SalePerson::where('user_id',$user_id)->first();
        if (!is_null($teacher))
            $teacher->delete();
    }
}
