<?php

use Illuminate\Support\Str;

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
            'url' => env('DATABASE_URL'),
            'database' => env('DB_DATABASE', database_path('database.sqlite')),
            'prefix' => '',
            'foreign_key_constraints' => env('DB_FOREIGN_KEYS', true),
        ],

        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DATABASE_URL'),
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


        'asterisk' => [
            'driver' => 'mysql',
            'host' => env('predictivo75_HOST', '192.168.1.75'),
            'port' => env('predictivo75_PORT', '3306'),
            'database' => env('predictivo75_DATABASE', 'forge'),
            'username' => env('predictivo75_USERNAME', 'forge'),
            'password' => env('predictivo75_PASSWORD', ''),
            'unix_socket' => env('predictivo75_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
        ],

        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'host' => env('cobranza_HOST', '192.168.1.100'),
            'port' => env('cobranza_PORT', '1433'),
            'database' => env('cobranza_DATABASE', 'sii_cobranza'),
            'username' => env('cobranza_USERNAME', 'sii'),
            'password' => env('cobranza_PASSWORD', '123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'sqlsrv2' => [
            'driver' => 'sqlsrv',
            'host' => env('cobranzaSeguridad_HOST', '192.168.1.100'),
            'port' => env('cobranzaSeguridad_PORT', '1433'),
            'database' => env('cobranzaSeguridad_DATABASE', 'Sii_Seguridad'),
            'username' => env('cobranzaSeguridad_USERNAME', 'sii'),
            'password' => env('cobranzaSeguridad_PASSWORD', '123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
        ],

        'sqlsrv3' => [
            'driver' => 'sqlsrv',
            'host' => env('cobranzaSeguridadventas_HOST', '192.168.1.100\MSSQLSERVER2008'),
            'port' => env('cobranzaSeguridadventas_PORT', ''),
            'database' => env('cobranzaSeguridadventas_DATABASE', 'Sii_Seguridad'),
            'username' => env('cobranzaSeguridadventas_USERNAME', 'sii'),
            'password' => env('cobranzaSeguridadventas_PASSWORD', '123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'instance' => 'MSSQLSERVER2008',
        ],

        'sqlsrv4' => [
            'driver' => 'sqlsrv',
            'host' => env('sii_callcenter_HOST', '192.168.1.100\MSSQLSERVER2008'),
            'port' => env('sii_callcenter_PORT', ''),
            'database' => env('sii_callcenter_DATABASE', 'sii_callcenter'),
            'username' => env('sii_callcenter_USERNAME', 'sii'),
            'password' => env('sii_callcenter_PASSWORD', '123'),
            'charset' => 'utf8',
            'prefix' => '',
            'prefix_indexes' => true,
            'instance' => 'MSSQLSERVER2008',
        ],

        'logpredictivo' => [
            'driver' => 'sqlsrv',
            'host' => env('procesos_HOST', '192.168.1.7'),
            'port' => env('procesos_PORT', '1433'),
            'database' => env('procesos_DATABASE', 'predictivo'),
            'username' => env('procesos_USERNAME', 'siii'),
            'password' => env('procesos_PASSWORD', '1234'),
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

        'client' => env('REDIS_CLIENT', 'predis'),

        'options' => [
            'cluster' => env('REDIS_CLUSTER', 'predis'),
            'prefix' => Str::slug(env('APP_NAME', 'laravel'), '_').'_database_',
        ],

        'default' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_DB', 0),
        ],

        'cache' => [
            'url' => env('REDIS_URL'),
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', 6379),
            'database' => env('REDIS_CACHE_DB', 1),
        ],

    ],

];
