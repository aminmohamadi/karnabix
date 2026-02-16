<?php


namespace App\Repositories\Interfaces;


use App\Models\Advertise;

interface AdvertiseRepositoryInterface
{
    public function getAllSite($search = null , $orderBy = null , $type = null , $category = null );
    public function save(Advertise $advertise);
    public function delete(Advertise $advertise);
    public function find($id);
    public function get($col , $value, $published = false);
    public function count();
    public function whereIn($col, array $value , $take = false , $published = false , $where = []);

    public function getNewObject();
}
