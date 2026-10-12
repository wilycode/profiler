<?php

declare(strict_types=1);

namespace WilyCode\Profiler;

interface ProfilerInterface
{
    public function start(string $name): ProfileSpanInterface;

    /**
     * @template T
     * @param callable():T $callback
     * @return T
     */
    public function measure(string $name, callable $callback): mixed;

    /**
     * Measure one detailed occurrence while retaining lightweight contextual data.
     *
     * @template T
     * @param array<string, scalar|null> $context
     * @param callable():T $callback
     * @return T
     */
    public function trace(string $name, array $context, callable $callback): mixed;

    /** @return array<string, ProfileMetric> */
    public function getMetrics(): array;

    /** @return list<ProfileTrace> */
    public function getTraces(): array;
}
