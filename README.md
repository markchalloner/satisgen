# SatisGen

[![Latest Version on Packagist](https://img.shields.io/packagist/v/markchalloner/satisgen.svg?style=flat-square)](https://packagist.org/packages/markchalloner/satisgen)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/markchalloner/satisgen/master.svg?style=flat-square)](https://travis-ci.org/markchalloner/satisgen)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/markchalloner/satisgen.svg?style=flat-square)](https://scrutinizer-ci.com/g/markchalloner/satisgen/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/markchalloner/satisgen.svg?style=flat-square)](https://scrutinizer-ci.com/g/markchalloner/satisgen)
[![Total Downloads](https://img.shields.io/packagist/dt/markchalloner/satisgen.svg?style=flat-square)](https://packagist.org/packages/markchalloner/satisgen)

## Introduction

A satis.php to satis.json generator. Allows you to separate your satis.json file and sensitive data into environment variables.

When run, will check for each environmental variables specified in the satis.php file and if found replace in the final satis.json or prompt the user to enter the data.

If the environmental variables are not found a [Dotenv] file is written at .env with the values from the user.

## Installation

Via Composer

``` bash
$ composer require markchalloner/satisgen
```

## Usage

Create a satis.php file.

Within this file use the function:

``` php
$config->getConfig($name, $description, $default = null, $validator = null, $secure = false);
```

For example

``` php
$config->getConfig('LICENCE', 'your licence key', null, function($answer) {
    if (16 !== strlen($answer)) {
        throw new \RuntimeException(
            'The licence should be 16 characters long'
        );
    }
    if (1 === preg_match('/[^a-f0-9]/i', $answer)) {
        throw new \RuntimeException(
            'The licence should include hexadecimal characters only'
        );
    }
    return $answer;
}, true);
```

Run

``` bash
vendor/bin/satisgen [input_file (default:satis.php)] [output_file (default:satis.json)]
```

### Example

Can be found under

```
tests/fixtures/satis.php
```

Run

``` bash
vendor/bin/satisgen vendor/markchalloner/satisgen/tests/fixtures/satis.php
```

## Change log

Please see [CHANGELOG] for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email mark.a.r.challoner@gmail.com instead of using the issue tracker.

## Notes

Built as a learning exercise with:

- [Symfony Console component]
- [Travis CI]
- [Packagist]
- [VersionEye]
- [SensioLabsInsight]
- [Scrutinizer]
- [The PHP League] guidelines
- [Shields.io]

to pull together other techniques:

- [Unit testing and code coverage]
- [Change log]
- [Licencing]
- [Semantic versioning]
- [Git hooks]
- [Dotenv]

to keep a record of archived tools and techniques:

- [Coveralls]
- [Badge Poser]

and to implement (todo):

- [Dependecy Injection] in a better way
  - [DIC] (Dependency Injection Containers)
  - [Traits] (PHP 5.4+)
- [PHPDoc]
- [Twig] for language independent templating

[Mark Challoner]: https://github.com/markchalloner
[CHANGELOG]: CHANGELOG.md
[Symfony Console component]: http://symfony.com/doc/current/components/console/introduction.html
[Travis CI]: https://travis-ci.org/markchalloner/satisgen
[Packagist]: https://packagist.org/packages/markchalloner/satisgen
[VersionEye]: https://packagist.org/packages/markchalloner/satisgen
[SensioLabsInsight]: https://insight.sensiolabs.com/projects/f790969b-1621-4d26-b2e2-3b9969a8570f
[Scrutinizer]: https://scrutinizer-ci.com/g/markchalloner/satisgen
[The PHP League]: https://thephpleague.com/
[Shields.io]: http://shields.io/
[Unit testing and code coverage]: https://phpunit.de/
[Change log]: http://keepachangelog.com/
[Licencing]: http://choosealicense.com/
[Semantic versioning]: http://semver.org/spec/v2.0.0.html
[Git hooks]: https://github.com/icefox/git-hooks
[Dotenv]: https://github.com/vlucas/phpdotenv
[Coveralls]: https://coveralls.io/repos/markchalloner/satisgen
[Badge Poser]: https://poser.pugx.org/
[Dependecy Injection]: http://fabien.potencier.org/article/12/do-you-need-a-dependency-injection-container
[DIC]: http://symfony.com/doc/current/components/dependency_injection/introduction.html
[Traits]: http://jasonlotito.com/programming/injectors-dependency-injection-with-traits
[PHPDoc]: http://www.phpdoc.org/
[Twig]: http://twig.sensiolabs.org/
