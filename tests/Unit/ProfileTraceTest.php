<?php

declare(strict_types=1);

namespace WilyCode\Profiler\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use WilyCode\Profiler\ProfileTrace;

final class ProfileTraceTest extends TestCase
{
    public function testStoresTraceValuesAndContext(): void
    {
        $context = ['table' => 'articles', 'count' => 3, 'cached' => false, 'note' => null];
        $trace = new ProfileTrace('db.query', 4.5, $context);

        self::assertSame('db.query', $trace->name());
        self::assertSame(4.5, $trace->durationMilliseconds());
        self::assertSame($context, $trace->context());
    }

    public function testDefaultsToEmptyContext(): void
    {
        self::assertSame([], (new ProfileTrace('operation', 0.0))->context());
    }

    public function testRejectsEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ProfileTrace('', 1.0);
    }

    public function testRejectsNegativeDuration(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ProfileTrace('operation', -1.0);
    }
}
