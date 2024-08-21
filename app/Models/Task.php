<?php

namespace App\Models;

use App\Enums\PriorityType;
use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'slug',
        'priority',
        'deadline',
        'active',
    ];

    protected $casts = [
        'deadline' => 'date',
        'status' => StatusType::class,
        'priority' => PriorityType::class
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function updateAttribute($id, $attribute, mixed $value): string
    {

        self::find($id)->update([
           $attribute => $value,
        ]);

        return $attribute;
    }
}
