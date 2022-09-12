<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Product extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'user_id',
        'is_active'
    ];

    //relationship to user
    /**
     * @var mixed
     */
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @var mixed
     */
    public function scopeIsActive($query, int $arg)
    {
        return $query->where('is_active', $arg);
    }

}
