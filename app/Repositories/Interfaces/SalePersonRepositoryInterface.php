<?php


namespace App\Repositories\Interfaces;


use App\Models\SalePerson;

interface SalePersonRepositoryInterface
{
    public function getAllAdmin($search , $per_page , $panel_status = false);

    public function find($id);

    public function destroy($id);

    public function newTeacherObject();

    public function save(SalePerson $salePerson);

    public function getAll();

    public function count();

    public function updateOrCreate(array $key , array $value);

    public function delete($user_id);
}
