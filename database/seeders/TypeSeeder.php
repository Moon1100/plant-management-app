<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['icon' => '', 'name_en' => 'Herb', 'name_my' => 'Herba', 'code' => 'HERB'],
            ['icon' => '', 'name_en' => 'Tree', 'name_my' => 'Pokok', 'code' => 'TREE'],
            ['icon' => '', 'name_en' => 'Vegetable', 'name_my' => 'Sayur', 'code' => 'VEG'],
            ['icon' => '', 'name_en' => 'Root', 'name_my' => 'Akar', 'code' => 'ROOT'],
            ['icon' => '', 'name_en' => 'Flower', 'name_my' => 'Bunga', 'code' => 'FLOW'],
            ['icon' => '', 'name_en' => 'Succulent', 'name_my' => 'Succulent', 'code' => 'SUCC'],
            ['icon' => '', 'name_en' => 'Fruit', 'name_my' => 'Buah', 'code' => 'FRUIT'],
            ['icon' => '', 'name_en' => 'Seedling', 'name_my' => 'Anak Pokok', 'code' => 'SEED'],
            ['icon' => '', 'name_en' => 'Grain', 'name_my' => 'Bijian', 'code' => 'GRAIN'],
            ['icon' => '', 'name_en' => 'Ornamental', 'name_my' => 'Hiasan', 'code' => 'ORN'],
        ];

        foreach ($types as $t) {
            Type::updateOrCreate(['code' => $t['code']], $t);
        }
    }
}
