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
        // ////sechma how the colums will look in the order_items table.

        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("order_id");
            $table->string("product_title");
            $table->decimal("price");
            $table->unsignedInteger("quantity");
            $table->decimal("admin_revenue");
            $table->decimal("ambassador_revenue");
            $table->timestamps();

            ////diffine forein key to connection between order_items and the orders tables
            $table->foreign("order_id")->references("id")->on("orders");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
