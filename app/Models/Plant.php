<?php

namespace App\Models;

use App\Services\PlantCodeService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plant_code',
        'planted_at',
        'insertion_date',
        'batch',
        'images',
        'notes',
        'farm_id',
    ];

    protected $casts = [
        'images' => 'array',
        'planted_at' => 'date',
        'insertion_date' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($plant) {
            if (!$plant->plant_code && $plant->farm) {
                $plantCodeService = app(PlantCodeService::class);
                $plant->plant_code = $plantCodeService->generateUniqueCode($plant->farm, $plant->name);
            }
        });
    }

    public function farm(): BelongsTo
    {
        return $this->belongsTo(Farm::class);
    }

    public function updates(): HasMany
    {
        return $this->hasMany(PlantUpdate::class)->orderBy('recorded_at', 'desc');
    }

    public function generateQrCode(): string
    {
        $url = route('plants.show', $this->plant_code);
        $filename = 'qr-codes/' . $this->plant_code . '.png';

        $qrCode = QrCode::format('png')
            ->size(200)
            ->generate($url);

        Storage::disk('public')->put($filename, $qrCode);

        $this->update(['qr_code_path' => $filename]);

        return $filename;
    }

    public function getQrCodeUrlAttribute(): ?string
    {
        return $this->qr_code_path ? Storage::url($this->qr_code_path) : null;
    }

    public function getRouteKeyName(): string
    {
        return 'plant_code';
    }
}
