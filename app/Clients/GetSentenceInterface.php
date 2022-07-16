<?php

namespace App\Clients;

interface GetSentenceInterface
{
    public function getHttpStatus();
    public function getSentence();
}
