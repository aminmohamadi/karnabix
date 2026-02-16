<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\Models\Activity as LogActivity;

class Cart extends LogActivity
{


    use HasFactory;

    protected $table = 'carts';
    public $timestamps = false;
    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
