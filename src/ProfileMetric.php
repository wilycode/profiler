<?php

declare(strict_types=1);

namespace WilyCode\Profiler;

final readonly class ProfileMetric
{
    public function __construct(
        private string $name,
        private int $count,
        private float $durationMilliseconds,
    ) {
        if ($this->name === '') {
            throw new \InvalidArgumentException('Profile metric name cannot be empty.');
        }
        if ($this->count < 1) {
            throw new \InvalidArgumentException('Profile metric count must be greater than zero.');
        }
        if ($this->durationMilliseconds < 0) {
            throw new \InvalidArgumentException('Profile metric duration cannot be negative.');
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function count(): int
    {
        return $this->count;
    }

    public function durationMilliseconds(): float
    {
        return $this->durationMilliseconds;
    }
}
