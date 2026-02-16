<?php

namespace App\Models;

use App\Enums\BankAccountEnum;
use App\Enums\CheckoutEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Morilog\Jalali\Jalalian;

/**
 * @method static latest(string $string)
 * @method static where(array $where)
 * @property mixed $status
 */
class SalePersonCheckout extends Model
{
    use HasFactory  , Searchable;

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

    public function bankAccountInfo(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(CheckoutEnum::getStatus())) ? CheckoutEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }
}
