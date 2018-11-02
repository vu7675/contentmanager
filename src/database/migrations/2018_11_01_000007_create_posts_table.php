<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'posts';

    /**
     * Run the migrations.
     * @table posts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('category_id');
            $table->string('title', 191);
            $table->string('slug', 191);
            $table->string('cover', 191)->nullable();
            $table->string('meta-description')->nullable();
            $table->longText('body');
            $table->timestamps();
            $table->softDeletes();

            $table->index(["category_id"], 'fk_posts_categories_idx');

            $table->unique(["slug"], 'slug_UNIQUE');

            $table->unique(["title"], 'title_UNIQUE');


            $table->foreign('category_id', 'fk_posts_categories_idx')
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
