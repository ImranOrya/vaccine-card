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
        Schema::create('finance_permission_subs', function (Blueprint $table) {
            $table->id();
            $table->boolean('edit');
            $table->boolean('delete');
            $table->boolean('add');
            $table->boolean('view');
            $table->unsignedBigInteger('finance_permission_id');
            $table->foreign('finance_permission_id')->references('id')->on('finance_permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('sub_permission_id');
            $table->foreign('sub_permission_id')->references('id')->on('sub_permissions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->index(["finance_permission_id", "sub_permission_id"], 'finance_sub_permission_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finance_permission_subs');
    }
};
