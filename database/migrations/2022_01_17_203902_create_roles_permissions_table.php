<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles_permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('rolde_id');
            $table->unsignedBigInteger('permission_id');
            
            $table->foreign('role_id')->reference('id')->on('roles')->onDelete('cascade');
            $table->foreign('permission_id')->reference('id')->on('permissions')->onDelete('cascade');

            $table->primary(['rolde_id', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles_permissions');
    }
}
