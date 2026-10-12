# Contributing to WilyCode Profiler

Thanks for helping improve WilyCode Profiler.

This package is part of the [WilyCode PHP ecosystem](https://github.com/wilycode/wilycode). The central repository will serve as a directory of libraries and shared documentation.

## Before opening a pull request

1. Open an issue first for major changes to public interfaces.
2. Keep this package limited to neutral profiling contracts and value objects; concrete timers and storage belong in implementation packages.
3. Use PHP 8.4, strict types, PSR-4 namespacing, and four-space indentation.
4. Add or update tests for behavior changes and update README if the public API changes.
5. Run `composer validate --strict` and `composer test`.

Please keep pull requests focused and explain the reason for the change. Report security concerns privately through GitHub rather than disclosing them in a public issue.
