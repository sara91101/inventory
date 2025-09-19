<?php

use App\Models\ExpensesItem;
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
        Schema::create('expenses_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('item');
            $table->softDeletes();
            $table->timestamps();
        });

        ExpensesItem::create(['item' => 'إيجار']);
        ExpensesItem::create(['item' => 'ترحيل']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expenses_items');
    }
};
