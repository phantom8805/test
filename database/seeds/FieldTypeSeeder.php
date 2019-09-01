<?php

use Illuminate\Database\Seeder;

class FieldTypeSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            'input'        => 0,
            'date'         => 0,
            'select'       => 1,
            'multi-select' => 1,
        ];

        $data = [];

        $time = (\Carbon\Carbon::now())->toDateTimeString();

        foreach ($types as $name => $optionAble) {
            $data[] = [
                'name'        => $name,
                'option_able' => $optionAble,
                'created_at'  => $time,
                'updated_at'  => $time,
            ];
        }

        \Illuminate\Support\Facades\DB::table('field_types')->insert($data);
    }
}
