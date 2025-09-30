<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('system_customizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('topbar_cart')->default(1);
            $table->integer('topbar_chat')->default(1);
            $table->integer('topbar_notifications')->default(1);
            $table->integer('topbar_panel')->default(1);
            $table->integer('topbar_quick_actions')->default(1);
            $table->integer('topbar_search')->default(1);
            $table->integer('sticky_toolbar')->default(1);
            $table->timestamps();
        });
        Schema::create('system_optimizations', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('active')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('system_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('application_name');
            $table->string('application_version');
            $table->timestamps();
        });
        Schema::create('system_status_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamp('date')->nullable();
            $table->timestamp('datetime')->nullable();
            $table->string('file')->nullable();
            $table->string('name');
            $table->json('properties')->nullable();
            $table->integer('active')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->softDeletes();
        });
        Schema::create('system_backup_databases', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamp('date_start')->nullable();
            $table->timestamp('date_end')->nullable();
            $table->timestamp('date')->nullable();
            $table->string('file')->nullable();
            $table->string('name');
            $table->string('path');
            $table->integer('active')->default(1);
            $table->integer('status')->default(1);
            $table->timestamps();
            $table->integer('created_by')->default(1);
            $table->integer('updated_by')->default(1);
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('system_customizations');
        Schema::dropIfExists('system_optimizations');
        Schema::dropIfExists('system_settings');
        Schema::dropIfExists('system_status_filters');
        Schema::dropIfExists('system_backup_databases');
    }
};
