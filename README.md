# SatisGen

A satis.php to satis.json generator. Built as a learning exercise for:

- Symfony Console component
- Travis CI
- Packagist

and to pull together other project techniques:

- Unit testing and code coverage
- Change log
- Licencing
- Semantic versioning
- Git hooks

## Installation

    composer install markchalloner/satisgen

## Usage

     vendor/bin/satisgen [input_file] [output_file]

## Notes

The same functionality could be achieved using:

    php -e satis.php > satis.json

but SatisGen does save a few characters ;)

