<?php

namespace App\Clients\MetaphorpsumClient;

use App\Clients\GetSentenceInterface;
use Illuminate\Support\Facades\Http;

class MetaphorpsumGetSentence implements GetSentenceInterface
{
    private $response;

    public function __construct()
    {
        $this->response = Http::get(
            config('metaphorpsum.get_sentence_url') . '/' . config('metaphorpsum.get_sentence_count')
        );
    }

    /**
     * Get sentence from metaphorpsum
     *
     * @return string
     */
    public function getSentence()
    {
        return $this->response->body();
    }

    /**
     * Get the status code of the response
     *
     * @return int
     */
    public function getHttpStatus()
    {
        return $this->response->status();
    }
}
