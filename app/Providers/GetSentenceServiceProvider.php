<?php

namespace App\Providers;

use App\Clients\GetSentenceInterface;
use App\Clients\ItsthisforthatClient\ItsthisforthatGetSentence;
use App\Clients\MetaphorpsumClient\MetaphorpsumGetSentence;
use Illuminate\Support\ServiceProvider;

class GetSentenceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(GetSentenceInterface::class, function ($app, $param) {
            switch ($param['client']) {
                case 'Metaphorpsum':
                    return new MetaphorpsumGetSentence();
                    break;

                case 'Itsthisforthat':
                default:
                    return new ItsthisforthatGetSentence();
                    break;
            }
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
