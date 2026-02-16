<?php

namespace App\Http\Controllers\Admin\Advertises;

use App\Enums\ArticleEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Classes\AdvertiseRepository;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use Livewire\WithPagination;

class IndexAdvertise extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status','category'];
    public ?string $status = null ,$category = null, $placeholder = 'عنوان یا نام مستعار';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->advertiseRepository = app(AdvertiseRepository::class);
    }

    public function mount()
    {
        $this->data['status'] = [
            'pending'=>'در انتظار تایید',
            'confirmed'=>'تایید شده',
            'rejected'=>'رد شده',

        ];

        $this->data['categories'] = config('jobs.jobs.categories');
    }

    public function render()
    {
        $this->authorizing('show_articles');

        $articles = $this->advertiseRepository->getAllSite($search = null, $orderBy = null, $type = null, $category = $this->category, $status = $this->status);
        return view('admin.advertises.index-advertise',['articles'=>$articles])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_articles');
        $article = $this->advertiseRepository->find($id);
        $this->advertiseRepository->delete($article);
    }
}
