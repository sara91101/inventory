<?php

use App\Models\Branch;
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
        Schema::create('branches', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('branch');
            $table->softDeletes();
            $table->timestamps();
        });

        Branch::create(['branch' => 'الفرع الرئيسي']);
        Branch::create(['branch' => 'فرع مدني']);
        Branch::create(['branch' => 'فرع كريمه']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
