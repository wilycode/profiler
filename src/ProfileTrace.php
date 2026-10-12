<?php

declare(strict_types=1);

namespace WilyCode\Profiler;

final readonly class ProfileTrace
{
    /** @param array<string, scalar|null> $context */
    public function __construct(
        private string $name,
        private float $durationMilliseconds,
        private array $context = [],
    ) {
        if ($this->name === '') {
            throw new \InvalidArgumentException('Profile trace name cannot be empty.');
        }
        if ($this->durationMilliseconds < 0) {
            throw new \InvalidArgumentException('Profile trace duration cannot be negative.');
        }
    }

    public function name(): string
    {
        return $this->name;
    }

    public function durationMilliseconds(): float
    {
        return $this->durationMilliseconds;
    }

    /** @return array<string, scalar|null> */
    public function context(): array
    {
        return $this->context;
    }
}
