<?php

namespace App\Services;

use App\Models\Farm;
use App\Models\Plant;
use Illuminate\Support\Str;

class PlantCodeService
{
    public function generateUniqueCode(Farm $farm, ?string $plantName = null): string
    {
        $prefix = $this->generatePrefix($farm, $plantName);
        $increment = $this->getNextIncrement($farm, $prefix);

        $code = $prefix . '-' . str_pad($increment, 3, '0', STR_PAD_LEFT);

        // Ensure uniqueness by checking if code already exists
        while ($this->codeExists($farm, $code)) {
            $increment++;
            $code = $prefix . '-' . str_pad($increment, 3, '0', STR_PAD_LEFT);
        }

        return $code;
    }

    private function generatePrefix(Farm $farm, ?string $plantName = null): string
    {
        if ($plantName) {
            // Use plant name if provided
            $slug = Str::slug($plantName, '');
            return strtoupper(substr($slug, 0, 3));
        }

        // Fallback to farm name
        $farmSlug = Str::slug($farm->name, '');
        return strtoupper(substr($farmSlug, 0, 3));
    }

    private function getNextIncrement(Farm $farm, string $prefix): int
    {
        $lastPlant = Plant::where('farm_id', $farm->id)
            ->where('plant_code', 'like', $prefix . '-%')
            ->orderBy('plant_code', 'desc')
            ->first();

        if (!$lastPlant) {
            return 1;
        }

        // Extract the numeric part from the last code
        $codeParts = explode('-', $lastPlant->plant_code);
        $lastNumber = (int) end($codeParts);

        return $lastNumber + 1;
    }

    private function codeExists(Farm $farm, string $code): bool
    {
        return Plant::where('farm_id', $farm->id)
            ->where('plant_code', $code)
            ->exists();
    }
}
