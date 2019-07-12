<?php
namespace DbFakerMask;

use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class DbFakerMask
{

    /**
     * The other config options.
     *
     * @var array
     */
    protected $options;

    /**
     *
     * @var Faker
     */
    protected $faker;

    /**
     *
     * @param array $options
     */
    public function __construct(array $options, Faker $faker)
    {
        $this->options = $options;
        $this->faker = $faker;
    }

    public function mask()
    {
        $tables = $this->options['tables'];
        $chunk = $this->options['chunk'] ?? 100;

        foreach ($tables as $table => $tableFields) {

            DB::table($table)->orderByRaw('1')->chunk($chunk, function ($records) use ($table, $tableFields) {

                foreach ($records as $record) {
                    $fields = [];

                    $record = (array) $record;

                    foreach ($tableFields as $field => $fieldConfig) {

                        if (is_callable($fieldConfig)) {
                            $value = $fieldConfig($this->faker, $record);
                        } else {
                            $value = $this->faker->{$fieldConfig};
                        }

                        $fields[$field] = $value;
                    }
                }

                $this->update($table, $record, $fields);
            });
        }
    }

    /**
     * Update table records
     *
     * @param string $table
     * @param array $record
     * @param array $fields
     */
    public function update(string $table, array $record, array $fields)
    {
        DB::table($table)->where('id', '=', $record['id'])->update($fields);
    }
}