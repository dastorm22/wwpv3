<?php

namespace App\Console\Commands;

use App\Containers\Analysis;
use Illuminate\Console\Command;

class AnalysisCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analysis:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes source data and creates the price comparison cache';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info(sprintf('Generating the Analysis Comparison'));

        $analysis = new Analysis($this->output);
        $analysis->generateComparison();

        $this->info(sprintf('Generating the Analysis Cross Reference'));
        $analysis->generateCrossReference();
    }
}
