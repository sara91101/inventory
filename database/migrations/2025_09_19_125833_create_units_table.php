<?php

use App\Models\Unit;
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
        Schema::create('units', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('unit');
            $table->softDeletes();
            $table->timestamps();
        });

        Unit::create(['unit' => 'متر']);
        Unit::create(['unit' => 'دسته']);
        Unit::create(['unit' => 'كيلو']);
        Unit::create(['unit' => 'طن']);
        Unit::create(['unit' => 'حبه']);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('units');
    }
};
