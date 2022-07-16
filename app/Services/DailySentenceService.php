<?php

namespace App\Services;

use App\Clients\GetSentenceInterface;

class DailySentenceService
{
    public $client;

    public function __construct(?string $client = null)
    {
        $this->client = $client;
    }

    /**
     * 設定 api 種類
     *
     * @param string $client
     * @return DailySentenceService
     */
    public function setClient($client)
    {
        $this->client = $client;
        return $this;
    }

    /**
     * 從第三方 API 服務取得每日一句
     *
     * @return string
     */
    public function getSentence()
    {
        $service = app(GetSentenceInterface::class, ['client' => $this->client]);
        if ($service->getHttpStatus() !== 200) {
            // or throw Exception
            return '';
        }
        return $service->getSentence();
    }
}
