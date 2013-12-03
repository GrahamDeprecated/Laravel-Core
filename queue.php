<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Default Queue Driver
    |--------------------------------------------------------------------------
    |
    | The Laravel queue API supports a variety of back-ends via an unified
    | API, giving you convenient access to each back-end using the same
    | syntax for each one. Here you may set the default queue driver.
    |
    | Supported: "sync", "beanstalkd", "sqs", "iron"
    |
    */

    'default' => 'sync',

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Please read the Bootstrap CMS documentation on GitHub for more details.
    |
    */

    'connections' => array(

        'sync' => array(
            'driver' => 'sync'
        ),

        'beanstalkd' => array(
            'driver' => 'beanstalkd',
            'host'   => 'localhost',
            'queue'  => 'laravel-jobs',
            'mail'   => 'laravel-mail',
            'cron'   => 'laravel-cron'
        ),

        'sqs' => array(
            'driver' => 'sqs',
            'key'    => 'your-public-key',
            'secret' => 'your-secret-key',
            'region' => 'us-east-1',
            'queue'  => 'laravel-jobs',
            'mail'   => 'laravel-mail',
            'cron'   => 'laravel-cron'
        ),

        'iron' => array(
            'driver'  => 'iron',
            'project' => 'your-project-id',
            'token'   => 'your-token',
            'queue'   => 'laravel-jobs',
            'mail'    => 'laravel-mail',
            'cron'    => 'laravel-cron'
        )

    )

);
