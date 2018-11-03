<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminRoleTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'admin_role';

    /**
     * Run the migrations.
     * @table admin_role
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->unsignedInteger('admin_id');
            $table->unsignedInteger('role_id');

            $table->index(["admin_id"], 'fk_admin_idx');

            $table->index(["role_id"], 'fk_role_idx');


            $table->foreign('admin_id', 'fk_admin_idx')
                ->references('id')->on('admins')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('role_id', 'fk_role_idx')
                ->references('id')->on('roles')
                ->onDelete('no action')
                ->onUpdate('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
