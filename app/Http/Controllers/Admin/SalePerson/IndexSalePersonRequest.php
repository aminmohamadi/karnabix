<?php

namespace App\Http\Controllers\Admin\SalePerson;

use App\Enums\TeacherEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\SalePersonRequest;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use Livewire\WithPagination;

class IndexSalePersonRequest extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['status'];

    public ?string $status = null , $placeholder = 'شماره همراه';

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function mount()
    {
        $this->data['status'] = TeacherEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_salePerson_requests');
        $requests = SalePersonRequest::paginate(20);
        return view('admin.salePerson.index',['requests'=>$requests])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {

        $this->authorizing('delete_teacher_requests');
        SalePersonRequest::destroy($id);
    }
}
