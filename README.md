# Laravel DB Faker Masking

### Configuration

Available in config/db_mask.php


Sample configuration file

```php
    return [
        /*
         * |--------------------------------------------------------------------------
         * | DB Mask rules
         * |--------------------------------------------------------------------------
         * |
         */
        'chunk' => 1000,
        'tables' => [
            'users' => [
                'firstname' => 'firstName',
                'lastname' => 'lastName',
                'email' => function (Faker $faker) {
                    return $faker->email;
                },
                'number' => function (Faker $faker, array $record) {
                    return $record['id'] . $faker->numberBetween(0, 100000);
                }
            ]
        ]
    ];
```

### Usage

    artisan db:mask
