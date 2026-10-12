<?php

declare(strict_types=1);

namespace WilyCode\Profiler;

interface ProfileSpanInterface
{
    public function stop(): void;
}
