<?php

use App\Models\Warehouse;
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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('address')->nullable();
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });

        Warehouse::create(['name' => 'المخزن الرئيسي' , 'address' => 'مدني', 'branch_id' => 2]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
