<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use DbFakerMask\DbFakerMask;

class DbFakerMaskTest extends TestCase
{

    protected $dbFakerMask;

    protected function setUp()
    {
        /**
         *
         * @var \Illuminate\Foundation\Application $app
         */
        $app = require __DIR__ . '/bootstrap/app.php';
        $app->loadEnvironmentFrom('.env.testing');
        $app->make(\Tests\Kernel::class)->bootstrap();

        $faker = \Faker\Factory::create();

        $options = [
            'chunk' => 20,
            'tables' => [
                'users' => [
                    'firstname' => 'firstName',
                    'lastname' => 'lastName'
                ]
            ]
        ];

        $this->dbFakerMask = new DbFakerMask($options, $faker);
    }

    public function testConstructor()
    {
        $this->assertTrue($this->dbFakerMask instanceof DbFakerMask);
    }

    // public function testMasking()
    // {
    // $this->dbFakerMask->mask();

    // $this->assertTrue($this->dbFakerMask instanceof DbFakerMask);
    // }
}
