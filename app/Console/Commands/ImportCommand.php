<?php

namespace App\Console\Commands;

use App\Containers\ImportProducts;
use App\Source;
use App\Imports\ImportOfferSources;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ImportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:source {source}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import products form a source';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $sourceId = $this->argument('source');
        $source = Source::findOrFail($sourceId);

        $this->info(sprintf('Importing Products from source %s', $source->name));
        $file = $source->file;
        //dd($source);

        $filePath = $this->retrieveFilePath($source);
        (new ImportProducts($source, $this->output))->import($filePath);
        //(new ImportOfferSources($source, $this->output))->import($filePath);
    }

    /**
     * Returns the file path
     * If the file is remote, then it will be download.
     *
     * @param Source $source
     * @return string
     */
    protected function retrieveFilePath(Source $source)
    {
        $filePath = storage_path("app/imports/{$source->file}");

        // copy file from remote url (will be stored as the source filename)
        if ($source->type == Source::TYPE_REMOTE) {
            $url = $source->url;

            // Follow redirects to ge the final filename
            $client = new Client(['allow_redirects' => ['track_redirects' => true]]);
            $response  = $client->get($source->url);
            $redirectedUrls = $response->getHeader(\GuzzleHttp\RedirectMiddleware::HISTORY_HEADER);

            if(count($redirectedUrls)) {
                $url = $redirectedUrls[count($redirectedUrls) - 1];
            }


            // Getting extension (needed for identifying the type of spreadsheet)
            $info = pathinfo($url);
            $filename = $source->id . '.' . $info['extension'];
            $filePath = storage_path("app/imports/{$filename}");

            $this->output->writeln(sprintf('Downloading %s', $url));
            copy($url, storage_path("app/imports/{$filename}"));

            // Saving new filename
            $source->file = $filename;
            $source->save();
        }

        return $filePath;
    }
}
