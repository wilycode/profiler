<?php

declare(strict_types=1);

namespace WilyCode\Profiler\Tests\Unit;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use WilyCode\Profiler\ProfileMetric;

final class ProfileMetricTest extends TestCase
{
    public function testStoresMetricValues(): void
    {
        $metric = new ProfileMetric('db.query', 3, 12.5);

        self::assertSame('db.query', $metric->name());
        self::assertSame(3, $metric->count());
        self::assertSame(12.5, $metric->durationMilliseconds());
    }

    public function testAcceptsZeroDuration(): void
    {
        self::assertSame(0.0, (new ProfileMetric('fast', 1, 0.0))->durationMilliseconds());
    }

    public function testRejectsEmptyName(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ProfileMetric('', 1, 1.0);
    }

    public function testRejectsNonPositiveCount(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ProfileMetric('metric', 0, 1.0);
    }

    public function testRejectsNegativeDuration(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new ProfileMetric('metric', 1, -0.1);
    }
}
