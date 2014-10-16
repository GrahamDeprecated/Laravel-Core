Laravel Core
============

Laravel Core was created by, and is maintained by [Graham Campbell](https://github.com/GrahamCampbell), and provides some extra functionality for [Laravel 5](http://laravel.com). Feel free to check out the [change log](CHANGELOG.md), [releases](https://github.com/GrahamCampbell/Laravel-Core/releases), [license](LICENSE.md), [api docs](http://docs.grahamjcampbell.co.uk), and [contribution guidelines](CONTRIBUTING.md).

![Laravel Core](https://cloud.githubusercontent.com/assets/2829600/4432284/a987fd4a-468c-11e4-814b-f0d09118089c.PNG)

<p align="center">
<a href="https://travis-ci.org/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/travis/GrahamCampbell/Laravel-Core/master.svg?style=flat-square" alt="Build Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core/code-structure"><img src="https://img.shields.io/scrutinizer/coverage/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Coverage Status"></img></a>
<a href="https://scrutinizer-ci.com/g/GrahamCampbell/Laravel-Core"><img src="https://img.shields.io/scrutinizer/g/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Quality Score"></img></a>
<a href="LICENSE.md"><img src="https://img.shields.io/badge/license-Apache%202.0-brightgreen.svg?style=flat-square" alt="Software License"></img></a>
<a href="https://github.com/GrahamCampbell/Laravel-Core/releases"><img src="https://img.shields.io/github/release/GrahamCampbell/Laravel-Core.svg?style=flat-square" alt="Latest Version"></img></a>
</p>


## Installation

[PHP](https://php.net) 5.4+ or [HHVM](http://hhvm.com) 3.2+, and [Composer](https://getcomposer.org) are required.

To get the latest version of Laravel Core, simply require `"graham-campbell/core": "~2.0"` in your `composer.json` file. You'll then need to run `composer install` or `composer update` to download it and have the autoloader updated.

Once Laravel Core is installed, you need to register the service provider. Open up `app/config/app.php` and add the following to the `providers` key.

* `'GrahamCampbell\Core\CoreServiceProvider'`

You can now utilise the classes and filters in this package to speed up writing Laravel apps or packages further.

#### Looking for a laravel 4 compatable version?

Checkout the [1.0 branch](https://github.com/GrahamCampbell/Laravel-Core/tree/1.0), installable by requiring `"graham-campbell/core": "~1.0"`.


## Configuration

Laravel Core supports optional configuration.

To get started, first publish the package config file:

```bash
$ php artisan publish:config graham-campbell/core
```

There are two config options:

##### Home Page URL

This option (`'home'`) defines the url to use for the home page. The default value for this setting is `'/'`.

##### Enable Commands

This option (`'commands'`) enables the install/update/reset commands and bindings shipped with this package. Other packages can read this config to save time by not registering event command event listeners if command are disabled. The default value for this setting is `true`.


## Usage

There is currently no usage documentation besides the [API Documentation](http://docs.grahamjcampbell.co.uk) for Laravel Core.

You may see an example of implementation in [Laravel Credentials](https://github.com/GrahamCampbell/Laravel-Credentials) or [Bootstrap CMS](https://github.com/GrahamCampbell/Bootstrap-CMS).


## License

Apache License

Copyright 2013-2014 Graham Campbell

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.
