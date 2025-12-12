<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SoftwareCategory;
use Illuminate\Support\Str;

class SoftwareCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Clinic and Diagnostic',
            'Online Dealer and Distributor',
            'Dealer and Distributor',
            'Jewelry Software',
            'School Management',
            'ERP Solutions'
        ];

        foreach ($categories as $categoryName) {
            SoftwareCategory::updateOrCreate(
                ['slug' => Str::slug($categoryName)], // Check by slug to avoid duplicates
                [
                    'name' => $categoryName,
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}