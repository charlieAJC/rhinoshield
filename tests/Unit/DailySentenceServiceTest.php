<?php

namespace Tests\Unit;

use App\Clients\GetSentenceInterface;
use App\Clients\ItsthisforthatClient\ItsthisforthatGetSentence;
use App\Clients\MetaphorpsumClient\MetaphorpsumGetSentence;
use App\Services\DailySentenceService;
use Tests\TestCase;

class DailySentenceServiceTest extends TestCase
{
    private $dailySentenceService = null;

    public function setUp(): void
    {
        parent::setUp();
        $this->dailySentenceService = $this->app->make(DailySentenceService::class);
    }

    // php artisan test --filter DailySentenceServiceTest
    public function test_get_sentence_from_itsthisforthat()
    {
        $exceptHttpStatus = 200;
        $exceptSentence = 'Good Day!';

        $mock = $this->initMock(ItsthisforthatGetSentence::class);
        $mock->shouldReceive([
            'getHttpStatus' => $exceptHttpStatus,
            'getSentence' => $exceptSentence,
        ])
            ->once();
        $this->app->bind(GetSentenceInterface::class, function () use ($mock) {
            return $mock;
        });

        $result = $this->dailySentenceService->setClient('Itsthisforthat')->getSentence();
        $this->assertEquals($exceptSentence, $result);
    }

    public function test_get_sentence_from_metaphorpsum()
    {
        $exceptHttpStatus = 200;
        $exceptSentence = 'Nice Day!';

        $mock = $this->initMock(MetaphorpsumGetSentence::class);
        $mock->shouldReceive([
            'getHttpStatus' => $exceptHttpStatus,
            'getSentence' => $exceptSentence,
        ])
            ->once();
        $this->app->bind(GetSentenceInterface::class, function () use ($mock) {
            return $mock;
        });

        $result = $this->dailySentenceService->setClient('Metaphorpsum')->getSentence();
        $this->assertEquals($exceptSentence, $result);
    }

    public function test_get_sentence_without_setting_client()
    {
        $exceptHttpStatus = 200;
        $exceptSentence = 'Ouch!';

        $mock = $this->initMock(ItsthisforthatGetSentence::class);
        $mock->shouldReceive([
            'getHttpStatus' => $exceptHttpStatus,
            'getSentence' => $exceptSentence,
        ])
            ->once();
        $this->app->bind(GetSentenceInterface::class, function () use ($mock) {
            return $mock;
        });

        $result = $this->dailySentenceService->getSentence();
        $this->assertEquals($exceptSentence, $result);
    }

    public function test_get_sentence_http_status_404()
    {
        // 修改記錄在 config 的網址參數，導致 404 錯誤
        config(['metaphorpsum.get_sentence_count' => '/3/4']);

        $exceptHttpStatus = 404;
        $exceptSentence = '';

        $mock = $this->initMock(MetaphorpsumGetSentence::class);
        $mock->shouldReceive(['getHttpStatus' => $exceptHttpStatus])
            ->once();
        $this->app->bind(GetSentenceInterface::class, function () use ($mock) {
            return $mock;
        });

        $result = $this->dailySentenceService->setClient('Metaphorpsum')->getSentence();
        $this->assertEquals($exceptSentence, $result);
    }
}
