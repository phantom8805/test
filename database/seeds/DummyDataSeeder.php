<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DummyDataSeeder extends Seeder
{
    /**
     * @var Faker
     */
    protected $faker;

    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->faker = app(Faker::class);
        $this->makeContacts();

        $contacts = \App\Contact::all();

        $this->makeDocs($contacts);
        $this->makeContactFields($contacts);
        $this->makeFieldOptions();

    }

    protected function makeContacts(): void
    {
        $data = [];

        $time = (\Carbon\Carbon::now())->toDateTimeString();

        for ($i = 0; $i < 10; $i++) {
            $data[] = [
                'name'       => $this->faker->name,
                'surname'    => $this->faker->lastName,
                'created_at' => $time,
                'updated_at' => $time,
                'deleted_at' => $i % 5 ? $time : null
            ];
        }

        \Illuminate\Support\Facades\DB::table('contacts')->insert($data);
    }

    /**
     * @param \Illuminate\Support\Collection|\App\Contact[] $contacts
     */
    protected function makeDocs(\Illuminate\Support\Collection $contacts): void
    {
        $time = (\Carbon\Carbon::now())->toDateTimeString();
        $data = [];

        for ($i = 0; $i < 10; $i++) {
            foreach ($contacts as $contact) {
                $data[] = [
                    'number'     => $i . $contact->id,
                    'contact_id' => $contact->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                    'deleted_at' => ($i + $contact->id) % 5 ? $time : null
                ];
            }
        }

        \Illuminate\Support\Facades\DB::table('docs')->insert($data);
    }

    /**
     * @param \Illuminate\Support\Collection|\App\Contact[] $contacts
     */
    protected function makeContactFields(\Illuminate\Support\Collection $contacts): void
    {
        $time = (\Carbon\Carbon::now())->toDateTimeString();

        $fieldTypes = \App\FieldType::all();

        $fields = [];

        for ($i = 0; $i < 10; $i++) {
            foreach ($contacts as $contact) {
                $fieldType = $fieldTypes->random();
                $fields[] = [
                    'title'      => $fieldType->id . '-' . $contact->id . '-' . $i,
                    'contact_id' => $contact->id,
                    'field_type' => $fieldType->id,
                    'created_at' => $time,
                    'updated_at' => $time,
                    'deleted_at' => ($i + $contact->id) % 5 ? $time : null
                ];
            }
        }

        \Illuminate\Support\Facades\DB::table('contact_fields')->insert($fields);
    }

    protected function makeFieldOptions()
    {
        $time = (\Carbon\Carbon::now())->toDateTimeString();

        $fields = \App\ContactField::all();

        $options = [];

        foreach ($fields as $field) {
            if ($field->type->option_able) {
                for ($i = 0; $i < 3; $i++) {
                    $options[] = [
                        'field_id'   => $field->id,
                        'key'        => $field->title,
                        'value'      => $field->title,
                        'selected'   => (bool)$i % 2,
                        'created_at' => $time,
                        'updated_at' => $time,
                    ];
                }
            } else {
                $options[] = [
                    'field_id'   => $field->id,
                    'key'        => $field->title,
                    'value'      => $field->title,
                    'selected'   => true,
                    'created_at' => $time,
                    'updated_at' => $time,
                ];
            }
        }

        \Illuminate\Support\Facades\DB::table('field_options')->insert($options);
    }

}
