<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'name_en', 'name_my', 'code'];

    public function plants(): BelongsToMany
    {
        return $this->belongsToMany(Plant::class);
    }
}
