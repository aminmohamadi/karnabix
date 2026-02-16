<?php

namespace App\Http\Controllers\Admin\SalePerson;

use App\Enums\StorageEnum;
use App\Enums\TeacherEnum;
use App\Events\TeacherEvent;
use App\Http\Controllers\BaseComponent;
use App\Models\SalePersonRequest;
use App\Repositories\Classes\SalePersonRepository;
use App\Repositories\Classes\SalePersonRequestRepository;
use App\Repositories\Classes\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StoreSalePerson extends BaseComponent
{
    public $request , $header;
    public $descriptions , $url , $files = [] , $status , $result;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->salePersonRequestRepositry = app(SalePersonRequestRepository::class);
        $this->userRepository = app(UserRepository::class);
        $this->salePersonRepositry = app(SalePersonRepository::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_teacher_requests');
        $this->data['status'] = TeacherEnum::getStatus();
        self::set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->request = SalePersonRequest::findOrFail($id);
            $this->header = " درخواست همکاری در فروش به شماره {$this->request->id}";
            $this->descriptions = $this->request->descriptions;
            $this->url = $this->request->url;
//            $this->files = array_filter($this->request->files);
            $this->status = $this->request->status;
            $this->result = $this->request->result;
        } else abort(404);
    }

    public function store()
    {
        $this->authorizing('edit_teacher_requests');
        $this->saveInDataBase($this->request);
    }

    private function saveInDataBase($model)
    {
//        dd($this->request->user->roles);
        $this->validate([
            'status' => ['required','string','in:'.implode(',',array_keys(TeacherEnum::getStatus()))],
            'result' => ['required','string','max:250000']
        ], [], [
            'status' => 'وضعیت',
            'result' => 'نتیجه نهایی'
        ]);

        try {
            DB::beginTransaction();
            $model->status = $this->status;
            $model->result = $this->result;
            $model->save();

            if ($model->wasChanged('status')) {
                $userRoles = $this->request->user->roles()->pluck('name','id')->toArray();
                if ($this->status == TeacherEnum::APPLY_CONFIRMED) {
                    if (!$this->request->user->hasRole('sale')) {
                        $userRoles[] = 'sale';
                        $this->userRepository->syncRoles($this->request->user,$userRoles);

                        $this->salePersonRepositry->updateOrCreate(['user_id'=>$model->user->id],['deleted_at'=>null]);

                    }
                } else {
                    if ($roleKey = array_search('sale',$userRoles)) {
                        unset($userRoles[$roleKey]);
                        $this->salePersonRepositry->delete($model->user->id);
                        $this->userRepository->syncRoles($this->request->user,$userRoles);
                    }
                }
                TeacherEvent::dispatch($model);
            }
            $this->emitNotify('اظلااعات با موقیت ذخیره شد');

            DB::commit();
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack();
            $this->emitNotify('خطایی در هنگام ثبت اطلاعات رخ داده است','warning');
            Log::error($e->getMessage());
        }
    }

    public function deleteItem()
    {
        $this->authorizing('delete_teacher_requests');
        $this->teacherRequestRepository->destroy($this->request->id);
        redirect()->route('admin.request');
    }

    public function download($file)
    {
        try {
            return getDisk(StorageEnum::PRIVATE)->download($file);
        } catch (\Exception $e) {
            $this->emitNotify('خطا در هنگام دانلود فایل','warning');
            Log::error($e->getMessage());
        }
    }

    public function render()
    {
        return view('admin.salePerson.store')->extends('admin.layouts.admin');
    }
}
