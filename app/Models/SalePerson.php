<?php

namespace App\Models;

use App\Enums\BankAccountEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

/**
 * @method static latest(string $string)
 * @method static where(array $where)
 * @property mixed $status
 */
class SalePerson extends Model
{
    use HasFactory  , Searchable,SoftDeletes;
    protected $table = 'sale_persons';

    protected $guarded = ['id'];
    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Jalalian::forge($value)->format('%A, %d %B %Y')
        );
    }
}
