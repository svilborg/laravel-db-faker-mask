<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use DbFakerMask\DbFakerMask;

class DbFakerMaskTest extends TestCase
{

    /**
     *
     * @var DbFakerMask
     */
    protected $dbFakerMask;

    /**
     *
     * {@inheritdoc}
     * @see \PHPUnit\Framework\TestCase::setUp()
     */
    protected function setUp()
    {
        /**
         *
         * @var \Illuminate\Foundation\Application $app
         */
        $app = require __DIR__ . '/bootstrap/app.php';
        $app->make(\Tests\Kernel::class)->bootstrap();

        $faker = \Faker\Factory::create();

        $options = [
            'chunk' => 20,
            'tables' => [
                'users' => [
                    'first_name' => 'firstName',
                    'last_name' => 'lastName'
                ]
            ]
        ];

        $this->dbFakerMask = new DbFakerMask($options, $faker);
    }

    public function testConstructor()
    {
        $this->assertTrue($this->dbFakerMask instanceof DbFakerMask);
    }

    public function testMasking()
    {
        $this->dbFakerMask->mask();

        $this->assertTrue($this->dbFakerMask instanceof DbFakerMask);
    }
}
