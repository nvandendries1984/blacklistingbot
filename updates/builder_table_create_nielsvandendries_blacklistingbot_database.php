<?php namespace NielsVanDenDries\Blacklistingbot\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateNielsvandendriesBlacklistingbotDatabase extends Migration
{
    public function up()
    {
        Schema::create('nielsvandendries_blacklistingbot_database', function($table)
        {
            $table->increments('id')->unsigned();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->string('username');
            $table->text('description');
            $table->text('tags');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('nielsvandendries_blacklistingbot_database');
    }
}
