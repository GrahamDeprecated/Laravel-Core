Laravel Core
============

Laravel Core was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides some extra functionality for [Laravel 5](http://laravel.com). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Core/releases), [license](LICENSE), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Core](https://cloud.githubusercontent.com/assets/2829600/4432284/a987fd4a-468c-11e4-814b-f0d09118089c.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Core/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Core/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

Either [PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+ are required.

To get the latest version of Laravel Core, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require graham-campbell/core
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "graham-campbell/core": "^4.0"
    }
}
```

Once Laravel Core is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Core\CoreServiceProvider'`

You can now utilize this package to provide a basic cli installation framework for your application.


## Configuration

Laravel Core requires no configuration. Just follow the simple install instructions and go!


## Usage

There is currently no usage documentation for Laravel Core, but we are open to pull requests.


## Security

If you discover a security vulnerability within this package, please send an e-mail to Graham Campbell at graham@alt-three.com. All security vulnerabilities will be promptly addressed.


## License

Laravel Core is licensed under [The MIT License (MIT)](LICENSE).
