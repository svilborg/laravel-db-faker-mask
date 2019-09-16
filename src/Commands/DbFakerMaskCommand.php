<?php
namespace DbFakerMask\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository as Config;
use Symfony\Component\Console\Input\InputOption;
use DbFakerMask\DbFakerMask;

/**
 * DbFakerMask
 */
class DbFakerMaskCommand extends Command
{

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'db:mask';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'DbFakerMask Command';

    /**
     * Configuration repository.
     *
     * @var Config
     */
    protected $config;

    /**
     *
     * @var DbFakerMask
     */
    protected $dbFakerMask;

    /**
     * Create a new command instance.
     *
     * @param \Illuminate\Contracts\Config\Repository $config
     * @return void
     */
    public function __construct(Config $config, DbFakerMask $dbFakerMask)
    {
        $this->config = $config;
        $this->dbFakerMask = $dbFakerMask;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->dbFakerMask->mask();

        $this->line('');
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            [
                'table',
                't',
                InputOption::VALUE_OPTIONAL,
                'Table',
                false
            ]
        ];
    }
}