<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    public function up()
    {
        // Permissions Table
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('guard_name', 100);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        // Roles Table
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('guard_name', 100);
            $table->timestamps();

            $table->unique(['name', 'guard_name']);
        });

        // Model Has Permissions Table
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->primary(['permission_id', 'model_id', 'model_type'], 'model_has_permissions_permission_model_type_primary');
        });

        // Model Has Roles Table
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('role_id');
            $table->string('model_type');
            $table->unsignedBigInteger('model_id');
            $table->index(['model_id', 'model_type']);
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->primary(['role_id', 'model_id', 'model_type'], 'model_has_roles_role_model_type_primary');
        });

        // Role Has Permissions Table
        Schema::create('role_has_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('permission_id');
            $table->unsignedBigInteger('role_id');

            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');

            $table->primary(['permission_id', 'role_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('model_has_roles');
        Schema::dropIfExists('model_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
}
