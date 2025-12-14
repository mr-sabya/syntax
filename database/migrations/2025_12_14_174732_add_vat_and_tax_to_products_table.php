<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Both fields are percentages. Default is 0.
            // Example: Store '15.00' for 15%.
            $table->decimal('vat', 8, 2)->default(0)->after('cost_price')->comment('VAT Percentage');
            $table->decimal('tax', 8, 2)->default(0)->after('vat')->comment('Tax Percentage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['vat', 'tax']);
        });
    }
};
