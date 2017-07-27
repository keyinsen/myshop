<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     * @table permission_role
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            $table->index(["role_id"], 'permission_role_role_id_index');

            $table->index(["permission_id"], 'permission_role_permission_id_index');
            $table->nullableTimestamps();


            $table->foreign('permission_id', 'permission_role_permission_id_index')
                ->references('id')->on('permissions')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('role_id', 'permission_role_role_id_index')
                ->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists('permission_role');
     }
}
