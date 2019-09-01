<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateContactsTable extends Migration
{

    const TABLE_NAME = 'contacts';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE_NAME, function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $table = self::TABLE_NAME;
        $columns = implode(',', \App\Contact::COLUMN_FOR_SEARCH);

        DB::select(DB::raw("ALTER TABLE `$table` ADD FULLTEXT INDEX `FullName` ($columns)"));
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
