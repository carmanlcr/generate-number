<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => env('DB_CONNECTION', 'mysql'),

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Laravel is shown below to make development simple.
    |
    |
    | All database work in Laravel is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'sqlite' => [
            'driver' => 'sqlite',
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3307'),
            'database' => env('DB_DATABASE', 'test'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'modes'       => [
                'ONLY_FULL_GROUP_BY',
                'STRICT_TRANS_TABLES',
                'NO_ZERO_IN_DATE',
                'NO_ZERO_DATE',
                'ERROR_FOR_DIVISION_BY_ZERO',
                'NO_ENGINE_SUBSTITUTION',
            ],
        ],

        'asterisk'  => [
            'driver'     => 'mysql',
            'host'       => env('ASTERISK_HOST', '190.60.237.102'),
            'port'       => env('ASTERISK_PORT', '3306'),
            'database'   => env('ASTERISK_DATABASE', 'asterisk'),
            'username'   => env('ASTERISK_USERNAME', 'lmorales'),
            'password'   => env('ASTERISK_PASSWORD', ''),
            'charset'    => 'utf8',
            'collation'  => 'utf8_unicode_ci',
            'prefix'     => '',
            'prefix_indexes' => true,
            'strict'     => true,
            'engine' => null,
        ],

        'instagram'  => [
            'driver'     => 'mysql',
            'host'       => env('INSTAGRAM_HOST', '27.0.0.1'),
            'port'       => env('INSTAGRAM_PORT', '3306'),
            'database'   => env('INSTAGRAM_DATABASE', 'instagram'),
            'username'   => env('INSTAGRAM_USERNAME', 'lmorales'),
            'password'   => env('INSTAGRAM_PASSWORD', ''),
            'charset'    => 'utf8',
            'collation'  => 'utf8_unicode_ci',
            'prefix'     => '',
            'prefix_indexes' => true,
            'strict'     => true,
            'engine' => null,
        ],

        'facebook'  => [
            'driver'     => 'mysql',
            'host'       => env('FACEBOOK_HOST', '27.0.0.1'),
            'port'       => env('FACEBOOK_PORT', '3306'),
            'database'   => env('FACEBOOK_DATABASE', 'facebook'),
            'username'   => env('FACEBOOK_USERNAME', 'lmorales'),
            'password'   => env('FACEBOOK_PASSWORD', ''),
            'charset'    => 'utf8',
            'collation'  => 'utf8_unicode_ci',
            'prefix'     => '',
            'prefix_indexes' => true,
            'strict'     => true,
            'engine' => null,
        ],

        'twitter'  => [
            'driver'     => 'mysql',
            'host'       => env('TWITTER_HOST', '27.0.0.1'),
            'port'       => env('TWITTER_PORT', '3306'),
            'database'   => env('TWITTER_DATABASE', 'twitter'),
            'username'   => env('TWITTER_USERNAME', 'lmorales'),
            'password'   => env('TWITTER_PASSWORD', ''),
            'charset'    => 'utf8',
            'collation'  => 'utf8_unicode_ci',
            'prefix'     => '',
            'prefix_indexes' => true,
            'strict'     => true,
            'engine' => null,
        ],

        'db_admin'  => [
            'driver'     => 'mysql',
            'host'       => env('DB_ADMIN_HOST', '27.0.0.1'),
            'port'       => env('DB_ADMIN_PORT', '3306'),
            'database'   => env('DB_ADMIN_DATABASE', 'db_admin'),
            'username'   => env('DB_ADMIN_USERNAME', 'lmorales'),
            'password'   => env('DB_ADMIN_PASSWORD', ''),
            'charset'    => 'utf8',
            'collation'  => 'utf8_unicode_ci',
            'prefix'     => '',
            'prefix_indexes' => true,
            'strict'     => true,
            'engine' => null,
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk haven't actually been run in the database.
    |
    */

    'migrations' => 'migrations',

    /*
    |--------------------------------------------------------------------------
    | Redis Databases
    |--------------------------------------------------------------------------
    |
    | Redis is an open source, fast, and advanced key-value store that also
    | provides a richer body of commands than a typical key-value system
    | such as APC or Memcached. Laravel makes it easy to dig right in.
    |
    */

    'redis' => [

        'client' => 'predis',

        'default' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
