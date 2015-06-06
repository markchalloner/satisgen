# SatisGen

[![Total Downloads](https://poser.pugx.org/markchalloner/satisgen/downloads)](https://packagist.org/packages/markchalloner/satisgen)
[![Latest Stable Version](https://poser.pugx.org/markchalloner/satisgen/v/stable)](https://packagist.org/packages/markchalloner/satisgen)
[![License](https://poser.pugx.org/markchalloner/satisgen/license)](https://packagist.org/packages/markchalloner/satisgen)
[![Build Status](https://travis-ci.org/markchalloner/satisgen.svg?branch=master)](https://travis-ci.org/markchalloner/satisgen)
[![Coverage Status](https://coveralls.io/repos/markchalloner/satisgen/badge.svg)](https://coveralls.io/r/markchalloner/satisgen)
[![Dependency Status](https://www.versioneye.com/user/projects/554d4b678a8e5655d6000076/badge.svg?style=flat)](https://www.versioneye.com/user/projects/554d4b678a8e5655d6000076)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/f790969b-1621-4d26-b2e2-3b9969a8570f/mini.png)](https://insight.sensiolabs.com/projects/f790969b-1621-4d26-b2e2-3b9969a8570f)

## Introduction

A satis.php to satis.json generator. Allows you to separate your satis.json file and sensitive data into environment variables.

When run, will check for each environmental variables specified in the satis.php file and if found replace in the final satis.json or prompt the user to enter the data.

If the environmental variables are not found a [Dotenv] file is written at .env with the values from the user.

## Installation

In your project run:

    composer require 'markchalloner/satisgen:1.0.0'

## Usage

Create a satis.php file.

Within this file use the function:

    $config->getConfig($name, $description, $default = null, $validator = null, $secure = false);

For example

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

Run

    vendor/bin/satisgen [input_file (default:satis.php)] [output_file (default:satis.json)]

### Example

Can be found under

    tests/fixtures/satis.php

Run

    vendor/bin/satisgen vendor/markchalloner/satisgen/tests/fixtures/satis.php

## Notes

Built as a learning exercise for:

- [Symfony Console component](http://symfony.com/doc/current/components/console/introduction.html)
- [Travis CI](https://travis-ci.org/markchalloner/satisgen)
- [Coveralls](https://coveralls.io/repos/markchalloner/satisgen)
- [Packagist](https://packagist.org/packages/markchalloner/satisgen)
- [VersionEye](https://packagist.org/packages/markchalloner/satisgen)
- [Badge Poser](https://poser.pugx.org/)
- [SensioLabsInsight](https://insight.sensiolabs.com/projects/f790969b-1621-4d26-b2e2-3b9969a8570f)

and to pull together other techniques:

- [Unit testing and code coverage](https://phpunit.de/)
- [Change log](http://keepachangelog.com/)
- [Licencing](http://choosealicense.com/)
- [Semantic versioning](http://semver.org/spec/v2.0.0.html)
- [Git hooks](https://github.com/icefox/git-hooks)

## Todos

- [Dependecy Injection](http://fabien.potencier.org/article/12/do-you-need-a-dependency-injection-container)
  - [DIC](http://symfony.com/doc/current/components/dependency_injection/introduction.html)
  - [Traits](http://jasonlotito.com/programming/injectors-dependency-injection-with-traits)
- [Scrutinizer](http://scrutinizer-ci.com)
- [PHPDoc](http://www.phpdoc.org/)

[Dotenv]: https://github.com/vlucas/phpdotenv

