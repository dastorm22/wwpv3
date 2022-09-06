<?php

namespace App\Console\Commands;

use App\Mail\CommandError;
use App\Source;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class ProcessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Imports enabled sources and runs the analysis at the end.';

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
        $errorMessages = [];

        $sources = Source::whereIsEnabled(true)->get();

        //importing sources
        foreach ($sources as $source) {
            try {
                $this->call('import:source', [
                    'source' => $source->id,
                ]);
            } catch (\Exception $e) {
                $errorMessages[] = sprintf('Importing source %s: %s [ %s ]', $source->id, $source->name, $e->getMessage());
                $this->error($e->getMessage());
            }
        }

        // generating analysis
        try {
            $this->call('analysis:generate');
        } catch (\Exception $e) {
            $errorMessages[] = sprintf('Generating Analysis [ %s ]', $e->getMessage());
            $this->error($e->getMessage());
        }

        // sending email if error occurred
        if (! empty($errorMessages)) {
            Mail::send(new CommandError($errorMessages));
        }
    }
}
