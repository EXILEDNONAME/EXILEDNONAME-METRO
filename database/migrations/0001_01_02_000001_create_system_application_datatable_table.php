<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_application_table_generals', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('file')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
        Schema::create('system_application_table_relations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_table_general')->unsigned();
            $table->timestamp('date')->nullable();
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('file')->nullable();
            $table->foreign('id_table_general')->references('id')->on('system_application_table_generals')->onDelete('cascade')->onUpdate('cascade');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_application_table_generals');
        Schema::dropIfExists('system_application_table_relations');
    }
};
