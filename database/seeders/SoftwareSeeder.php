<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Software;
use App\Models\SoftwareCategory;
use Illuminate\Support\Str;

class SoftwareSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Get Category IDs
        $clinicCat = SoftwareCategory::where('slug', 'clinic-and-diagnostic')->first()->id;
        $dealerCat = SoftwareCategory::where('slug', 'dealer-and-distributor')->first()->id;
        $onlineCat = SoftwareCategory::where('slug', 'online-dealer-and-distributor')->first()->id;
        $jewelryCat = SoftwareCategory::where('slug', 'jewelry-software')->first()->id;

        $softwares = [
            [
                'software_category_id' => $clinicCat,
                'name' => 'MediCare Pro System',
                'short_description' => 'Complete solution for managing patient history, appointments, and diagnostic reporting.',
                'long_description' => '<p>MediCare Pro is designed for modern clinics. It handles everything from <strong>patient registration</strong> to final billing. Includes modules for Pharmacy, Lab Tests, and Doctor scheduling.</p><p>Secure, fast, and reliable for high-volume hospitals.</p>',
                'price' => 199.00,
                'features' => ['Patient History Management', 'Doctor Scheduling', 'Lab Report Generation', 'Pharmacy Billing'],
                'version' => 'v2.5',
            ],
            [
                'software_category_id' => $clinicCat,
                'name' => 'DiagCenter X',
                'short_description' => 'Specialized software for diagnostic centers with barcode integration.',
                'long_description' => '<p>Streamline your pathology lab with DiagCenter X. Features auto-generation of reports and email delivery to patients.</p>',
                'price' => 0.00, // Free
                'features' => ['Barcode Integration', 'Email Reports', 'Expense Tracking'],
                'version' => 'v1.0',
            ],
            [
                'software_category_id' => $jewelryCat,
                'name' => 'GoldSmith ERP',
                'short_description' => 'Manage gold inventory, making charges, and daily rates easily.',
                'long_description' => '<p>The ultimate tool for jewelry shop owners. Calculate gold purity, making charges, and stone prices automatically based on daily gold rates.</p>',
                'price' => 450.00,
                'features' => ['Daily Gold Rate Update', 'Barcode Tagging', 'GST Billing', 'Stock Auditing'],
                'version' => 'v4.2',
            ],
            [
                'software_category_id' => $dealerCat,
                'name' => 'AutoParts Distributor',
                'short_description' => 'Inventory management for automobile spare parts dealers.',
                'long_description' => '<p>Track thousands of SKUs easily. Manage multiple warehouses and track sales reps in real-time.</p>',
                'price' => 299.00,
                'features' => ['Multi-Warehouse', 'Sales Rep Tracking', 'Invoicing'],
                'version' => 'v3.0',
            ],
            [
                'software_category_id' => $onlineCat,
                'name' => 'E-Dealer Connect',
                'short_description' => 'Cloud-based dealer management system accessible from anywhere.',
                'long_description' => '<p>Connect your manufacturers with your dealers. Allow dealers to place orders online and track shipment status.</p>',
                'price' => 50.00, // Monthly subscription style price
                'features' => ['Cloud Hosted', 'Mobile App Support', 'Order Tracking'],
                'version' => 'v1.1',
            ],
        ];

        foreach ($softwares as $soft) {
            Software::updateOrCreate(
                ['slug' => Str::slug($soft['name'])],
                [
                    'software_category_id' => $soft['software_category_id'],
                    'name' => $soft['name'],
                    'version' => $soft['version'],
                    'short_description' => $soft['short_description'],
                    'long_description' => $soft['long_description'],
                    'features' => $soft['features'], // Model casts this to JSON automatically
                    'price' => $soft['price'],
                    'is_active' => true,
                    'is_featured' => rand(0, 1),
                    // We leave images null for now, or you can add paths like 'assets/frontend/images/template-1.png'
                    'logo' => null, 
                    'banner_image' => null,
                    'demo_url' => 'https://google.com',
                ]
            );
        }
    }
}