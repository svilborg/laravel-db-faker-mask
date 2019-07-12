<?php
use Faker\Generator as Faker;

return [
    /*
     * |--------------------------------------------------------------------------
     * | DB Mask rules
     * |--------------------------------------------------------------------------
     * |
     */
    'chunk' => 1000,
    'tables' => [
//         'users' => [
//             'firstname' => 'firstName',
//             'lastname' => 'lastName',
//             'email' => function (Faker $faker) {
//                 return $faker->email;
//             },
//             'number' => function (Faker $faker, array $record) {
//                 return $record['id'] . $faker->numberBetween(0, 100000);
//             }
//         ]
    ]
];