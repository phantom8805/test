<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;


class CreateContactFieldsTable extends Migration
{
    const TABLE_NAME = 'contact_fields';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('contact_id');
            $table->unsignedInteger('field_type');
            $table->string('title');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->foreign('contact_id')
                ->references('id')
                ->on('contacts')
                ->onDelete('CASCADE');
            ;
        });

        Schema::table(self::TABLE_NAME, function (Blueprint $table) {
            $table->foreign('field_type')
                ->references('id')
                ->on('field_types')
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
