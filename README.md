Laravel Core
============

Laravel Core was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides some extra functionality for [Laravel 5](http://laravel.com). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Core/releases), [license](LICENSE), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Core](https://cloud.githubusercontent.com/assets/2829600/4432284/a987fd4a-468c-11e4-814b-f0d09118089c.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Core/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Core/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.3+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Core, simply add the following line to the require block of your `composer.json` file:

```
"graham-campbell/core": "~2.0"
```

You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Core is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Core\CoreServiceProvider'`

You can now utilise the classes in this package to speed up writing Laravel apps or packages further.

#### Looking for a laravel 4 compatable version?

Checkout the [1.0 branch](https://github.com/GrahamCampbell/Laravel-Core/tree/1.0), installable by requiring `"graham-campbell/core": "~1.0"`.


## Configuration

Laravel Core supports optional configuration.

To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish
```

This will create a `config/core.php` file in your app that you can modify to set your configuration. Also, make sure you check for changes to the original config file in this package between releases.

There are 5 different settings provided in this config. The intention here is to allow you to have a centralised point for common configuration that lots of packages and services can depend on.


## Usage

There is currently no usage documentation besides the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Core.


## License

Laravel Core is licensed under [The MIT License (MIT)](LICENSE).
