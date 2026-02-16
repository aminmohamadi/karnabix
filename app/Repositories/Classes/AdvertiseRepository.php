<?php


namespace App\Repositories\Classes;

use App\Enums\CourseEnum;
use App\Enums\OrderEnum;
use App\Enums\SampleEnum;
use App\Models\Advertise;
use App\Models\Course;
use App\Repositories\Interfaces\AdvertiseRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class AdvertiseRepository implements AdvertiseRepositoryInterface
{

    public function getAllSite($search = null, $orderBy = null, $type = null, $category = null, $status = null,int $count = 12,array $where = null)
    {

        return Advertise::when($type, function ($q) use ($type) {
            return match ($type) {
                '1' => $q->where('job_type', '=', 1),
                '2' => $q->where('job_type', '=', 2),
                '3' => $q->where('job_type', '=', 3),
                default => $q,
            };
        })->when($status, function ($q) use ($status) {
            return match ($status) {
                'pending' => $q->where('status', '=', 0),
                'confirmed' => $q->where('status', '=', 1),
                'rejected' => $q->where('status', '=', 2),
                default => $q,
            };        })
            ->when($category, function ($q) use ($category) {
                return $q->where('category', '=', $category);
            })
            ->when($orderBy, function ($q) use ($orderBy) {
                return match ($orderBy) {
                    'latest' => $q->latest('id'),
                    'oldest' => $q->oldest('id'),
                    default => $q,
                };
            }, function ($q) {
                return $q->latest('id');
            })->when($category, function ($q) use ($category) {
                return $q->where('category', '=', $category);
            })->where($where)
            ->paginate($count);
    }

    public function save(Advertise $advertise): Advertise
    {
        $advertise->save();
        return $advertise;
    }

    public function delete(Advertise $advertise): ?bool
    {
        return $advertise->delete();
    }

    public function find($id): Model|Collection|Builder|array|null
    {
        return Advertise::findOrFail($id);
    }

    public function get($col, $value, $published = false)
    {
        return $published ?
            Advertise::all()->where($col, $value)->firstOrfail() :
            Advertise::where($col, $value)->firstOrfail();
    }

    public function count()
    {
        return Advertise::count();
    }


    public function whereIn($col, array $value, $take = false, $published = false, $where = [])
    {
        return $take ? Advertise::where($where)->whereIn($col, $value)->take($take)->get() :
            Advertise::where($where)->whereIn($col, $value)->get();
    }

    public function getNewObject()
    {
        return new Advertise();
    }

    public function latest($count = 10)
    {
        return Advertise::latest()->where("status", 1)->take($count)->get();
    }

    public function getAllSiteCount($search = null, $orderBy = null, $type = null, $category = null, $status = null,int $count = 12,array $where = null)
    {

        return Advertise::when($type, function ($q) use ($type) {
            return match ($type) {
                '1' => $q->where('job_type', '=', 1),
                '2' => $q->where('job_type', '=', 2),
                '3' => $q->where('job_type', '=', 3),
                default => $q,
            };
        })->when($status, function ($q) use ($status) {
            return match ($status) {
                'pending' => $q->where('status', '=', 0),
                'confirmed' => $q->where('status', '=', 1),
                'rejected' => $q->where('status', '=', 2),
                default => $q,
            };        })
            ->when($category, function ($q) use ($category) {
                return $q->where('category', '=', $category);
            })
            ->when($orderBy, function ($q) use ($orderBy) {
                return match ($orderBy) {
                    'latest' => $q->latest('id'),
                    'oldest' => $q->oldest('id'),
                    default => $q,
                };
            }, function ($q) {
                return $q->latest('id');
            })->when($category, function ($q) use ($category) {
                return $q->where('category', '=', $category);
            })->where($where)
            ->count();
    }
}
