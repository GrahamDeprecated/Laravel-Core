<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Site Name
    |--------------------------------------------------------------------------
    |
    | This defines the site name.
    |
    | Default to 'Laravel Application'.
    |
    */

    'name' => 'Laravel Application',

    /*
    |--------------------------------------------------------------------------
    | Home Page URL
    |--------------------------------------------------------------------------
    |
    | This defines the url to use for the home page.
    |
    | Default to '/'.
    |
    */

    'home' => '/',

    /*
    |--------------------------------------------------------------------------
    | Page Layout
    |--------------------------------------------------------------------------
    |
    | This specifies the your views should extend.
    |
    | Default to 'layouts.default'.
    |
    */

    'default' => 'layouts.default',

    /*
    |--------------------------------------------------------------------------
    | Html Email Layout
    |--------------------------------------------------------------------------
    |
    | This specifies the view that your html email views should extend.
    |
    | Default to 'layouts.email'.
    |
    */

    'email' => 'layouts.email',

    /*
    |--------------------------------------------------------------------------
    | Text Email Layout
    |--------------------------------------------------------------------------
    |
    | This specifies the view that your text email views should extend.
    |
    | Default to 'layouts.text'.
    |
    */

    'text' => 'layouts.text',

    /*
    |--------------------------------------------------------------------------
    | Enable Commands
    |--------------------------------------------------------------------------
    |
    | This enables the install/update/reset commands and bindings shipped with
    | this package. Other packages can read this config to save time by not
    | registering event command event listeners if command are disabled.
    |
    | Default to true.
    |
    */

    'commands' => true,

];
