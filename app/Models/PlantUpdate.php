<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PlantUpdate extends Model
{
    use HasFactory;

    protected $fillable = [
        'plant_id',
        'user_id',
        'status',
        'title',
        'description',
        'note',
        'height',
        'pests',
        'diseases',
        'photos',
        'recorded_at',
    ];

    protected $casts = [
        'photos' => 'array',
        'recorded_at' => 'datetime',
    ];

    public function plant(): BelongsTo
    {
        return $this->belongsTo(Plant::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
