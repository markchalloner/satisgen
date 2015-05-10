# SatisGen

[![Total Downloads](https://poser.pugx.org/markchalloner/satisgen/downloads)](https://packagist.org/packages/markchalloner/satisgen)
[![Latest Stable Version](https://poser.pugx.org/markchalloner/satisgen/v/stable)](https://packagist.org/packages/markchalloner/satisgen)
[![License](https://poser.pugx.org/markchalloner/satisgen/license)](https://packagist.org/packages/markchalloner/satisgen)
[![Build Status](https://travis-ci.org/markchalloner/satisgen.svg?branch=master)](https://travis-ci.org/markchalloner/satisgen)
[![Coverage Status](https://coveralls.io/repos/markchalloner/satisgen/badge.svg)](https://coveralls.io/r/markchalloner/satisgen)
[![Dependency Status](https://www.versioneye.com/user/projects/554d4b678a8e5655d6000076/badge.svg?style=flat)](https://www.versioneye.com/user/projects/554d4b678a8e5655d6000076)




A satis.php to satis.json generator. Built as a learning exercise for:

- [Symfony Console component](http://symfony.com/doc/current/components/console/introduction.html)
- [Travis CI](https://travis-ci.org/markchalloner/satisgen)
- [Coveralls](https://coveralls.io/repos/markchalloner/satisgen)
- [Packagist](https://packagist.org/packages/markchalloner/satisgen)
- [VersionEye](https://packagist.org/packages/markchalloner/satisgen)
- [Badge Poser](https://poser.pugx.org/)

and to pull together other project techniques:

- [Unit testing and code coverage](https://phpunit.de/)
- [Change log](http://keepachangelog.com/)
- [Licencing](http://choosealicense.com/)
- [Semantic versioning](http://semver.org/spec/v2.0.0.html)
- [Git hooks](https://github.com/icefox/git-hooks)

## Installation

    composer install markchalloner/satisgen

## Usage

     vendor/bin/satisgen [input_file] [output_file]

## Notes

The same functionality could be achieved using:

    php -e satis.php > satis.json

but SatisGen does save a few characters ;)

