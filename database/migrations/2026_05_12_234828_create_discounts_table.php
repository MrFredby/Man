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
    Schema::create('discounts', function (Blueprint $table) {
        $table->id();
        $table->string('code')->unique()->nullable();
        $table->string('type'); // percent, fixed
        $table->decimal('value', 10, 2);
        $table->unsignedBigInteger('customer_group_id')->nullable();
        $table->integer('min_quantity')->nullable();
        $table->timestamp('starts_at')->nullable();
        $table->timestamp('expires_at')->nullable();
        $table->boolean('is_active')->default(true);
        $table->timestamps();

        $table->foreign('customer_group_id')->references('id')->on('customer_groups')->onDelete('set null');
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
