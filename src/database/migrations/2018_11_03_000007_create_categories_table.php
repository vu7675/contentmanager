<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'categories';

    /**
     * Run the migrations.
     * @table categories
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('parent_id')->nullable()->default(null);
            $table->string('name', 191);
            $table->string('slug', 191);
            $table->string('cover', 191)->nullable()->default(null);
            $table->string('meta-description', 191);

            $table->index(["parent_id"], 'fk_categories_categories1_idx');

            $table->unique(["name"], 'name_UNIQUE');

            $table->unique(["slug"], 'slug_UNIQUE');
            $table->softDeletes();
            $table->nullableTimestamps();


            $table->foreign('parent_id', 'fk_categories_categories1_idx')
                ->references('id')->on('categories')
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
