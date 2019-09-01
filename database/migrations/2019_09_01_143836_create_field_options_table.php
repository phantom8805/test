<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldOptionsTable extends Migration
{
    const TABLE_NAME = 'field_options';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('field_id');
            $table->string('key');
            $table->string('value');
            $table->boolean('selected');
            $table->timestamps();
        });

        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->foreign('field_id')
                ->references('id')
                ->on('contact_fields')
                ->onDelete('CASCADE');
            ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE_NAME);
    }
}
