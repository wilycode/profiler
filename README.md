# WilyCode Profiler

[![PHP 8.4+](https://img.shields.io/badge/PHP-8.4%2B-777BB4)](https://www.php.net/)
[![License: MIT](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)
[![Tests](https://github.com/wilycode/profiler/actions/workflows/tests.yml/badge.svg)](https://github.com/wilycode/profiler/actions/workflows/tests.yml)

**Framework-independent profiling contracts for PHP 8.4+.**

Use this package to add performance measurements to your code without tying it to a particular timer, framework, or reporting tool.

> **WilyCode PHP Ecosystem**
>
> This library is part of **[WilyCode](https://github.com/wilycode/wilycode)** — a collection of independent, reusable PHP components. Each component has its own repository, releases, and Composer package.
>
> **[Explore the WilyCode ecosystem →](https://github.com/wilycode/wilycode)**
>

## What does this package do?

`wilycode/profiler` defines a small API for collecting and reading performance measurements. It includes:

- `ProfilerInterface` — start a measurement, time a callback, or record a trace.
- `ProfileSpanInterface` — finish a manually started measurement.
- `ProfileMetric` — a named total duration and number of calls.
- `ProfileTrace` — an individual timed operation with optional context.

**This package does not measure time on its own.** Your application must provide an implementation of `ProfilerInterface`, such as the separate `wilycode/profiler-php` package when it becomes available.

## Requirements

- PHP 8.4 or newer.
- No additional runtime Composer dependencies.

## Installation

Once the first version is available on [Packagist](https://packagist.org/), install the contracts with:

```bash
composer require wilycode/profiler
```

To actually record timings, also install or implement a profiler that implements `ProfilerInterface`. Pass that instance to the code you want to measure, for example through dependency injection.

## Usage

The examples below assume `$profiler` is an instance of `WilyCode\Profiler\ProfilerInterface` supplied by your application.

### Measure a callback

Use `measure()` for a single operation. It returns the callback's result.

```php
use WilyCode\Profiler\ProfilerInterface;

function renderPage(ProfilerInterface $profiler): string
{
    return $profiler->measure(
        'page.render',
        static fn (): string => 'Hello, world!',
    );
}
```

### Start and stop a measurement

Use `start()` when the operation spans several statements. Always stop the span, including when an exception occurs.

```php
$span = $profiler->start('request.handle');

try {
    // Handle the request.
} finally {
    $span->stop();
}
```

### Record a trace with context

Use `trace()` when you also want to attach details to an individual operation.

```php
$articles = $profiler->trace(
    'db.query',
    ['operation' => 'fetchAll', 'table' => 'articles'],
    static fn (): array => ['First article', 'Second article'],
);
```

Context should contain simple scalar values (`string`, `int`, `float`, `bool`, or `null`). **Do not include credentials, tokens, or personal data.**

## Reading results

A profiler implementation exposes aggregated metrics and individual traces using the same interfaces.

**Metrics** group measurements by name:

```php
foreach ($profiler->getMetrics() as $metric) {
    printf(
        "%s: %d calls, %.2f ms\n",
        $metric->name(),
        $metric->count(),
        $metric->durationMilliseconds(),
    );
}
```

**Traces** describe individual measured operations:

```php
foreach ($profiler->getTraces() as $trace) {
    echo $trace->name() . ': ' . $trace->durationMilliseconds() . " ms\n";
    // $trace->context() returns the supplied context array.
}
```

The concrete profiler implementation determines how measurements are collected and stored.

## Related packages

| Package | Purpose | Relationship |
| --- | --- | --- |
| [`wilycode/router`](https://github.com/wilycode/router) | HTTP routing | Independent |
| [`wilycode/router-attribute`](https://github.com/wilycode/router-attribute) | Attribute-based route discovery | Independent |
| `wilycode/profiler-php` | PHP implementation of profiling contracts | Optional; planned |
| `wilycode/router-profiler` | Connects routing diagnostics to a profiler | Optional; planned |

Neither Router nor Router Attribute is required to use these contracts. The planned packages are listed for orientation and should not be assumed to be published yet.

## Development

Clone this repository and run:

```bash
composer install
composer validate --strict
composer test
```

The tests also run in [GitHub Actions](https://github.com/wilycode/profiler/actions). Source tests remain available on GitHub but are excluded from the standard distribution archive.

## Contributing

Bug reports and pull requests are welcome. Read [CONTRIBUTING.md](CONTRIBUTING.md) before contributing.

## License

MIT © 2026 Simon Piter. See [LICENSE](LICENSE).
