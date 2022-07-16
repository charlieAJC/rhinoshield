<?php

namespace App\Clients\ItsthisforthatClient;

use App\Clients\GetSentenceInterface;
use Illuminate\Support\Facades\Http;

class ItsthisforthatGetSentence implements GetSentenceInterface
{
    private $response;

    public function __construct()
    {
        $this->response = Http::get(config('itsthisforthat.get_sentence_url'));
    }

    /**
     * Get sentence from itsthisforthat
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
