<?php

namespace App\Console\Commands;

use App\Services\DailySentenceService;
use Illuminate\Console\Command;

class GetSentence extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get-sentence {client?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get sentence from api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(DailySentenceService $service)
    {
        $sentence = '';
        $client = $this->argument('client');
        switch ($client) {
            case 'Metaphorpsum':
            case 'Itsthisforthat':
                $sentence = $service->setClient($client)->getSentence();
                break;

            default:
                $this->comment('It seems that you don\'t choose a correct client. Let me choose Itsthisforthat for you :P');
                $sentence = $service->getSentence();
                break;
        }
        $this->info($sentence);
    }
}
