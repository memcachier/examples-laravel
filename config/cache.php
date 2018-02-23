<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Cache Store
    |--------------------------------------------------------------------------
    |
    | This option controls the default cache connection that gets used while
    | using this caching library. This connection is used when another is
    | not explicitly specified when executing a given caching function.
    |
    | Supported: "apc", "array", "database", "file", "memcached", "redis"
    |
    */

    'default' => env('CACHE_DRIVER', 'memcached'),

    /*
    |--------------------------------------------------------------------------
    | Cache Stores
    |--------------------------------------------------------------------------
    |
    | Here you may define all of the cache "stores" for your application as
    | well as their drivers. You may even define multiple stores for the
    | same cache driver to group types of items stored in your caches.
    |
    */

    'stores' => [

        'apc' => [
            'driver' => 'apc',
        ],

        'array' => [
            'driver' => 'array',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'cache',
            'connection' => null,
        ],

        'file' => [
            'driver' => 'file',
            'path' => storage_path('framework/cache/data'),
        ],

        'memcached' => [
            'driver' => 'memcached',
            'persistent_id' => 'memcached_pool_id',
            'sasl' => [
                env('MEMCACHIER_USERNAME'),
                env('MEMCACHIER_PASSWORD'),
            ],
            'options' => [
                // some nicer default options
                // - nicer TCP options
                Memcached::OPT_TCP_NODELAY => TRUE,
                Memcached::OPT_NO_BLOCK => FALSE,
                // - timeouts
                Memcached::OPT_CONNECT_TIMEOUT => 2000,    // ms
                Memcached::OPT_POLL_TIMEOUT => 2000,       // ms
                Memcached::OPT_RECV_TIMEOUT => 750 * 1000, // us
                Memcached::OPT_SEND_TIMEOUT => 750 * 1000, // us
                // - better failover
                Memcached::OPT_DISTRIBUTION => Memcached::DISTRIBUTION_CONSISTENT,
                Memcached::OPT_LIBKETAMA_COMPATIBLE => TRUE,
                Memcached::OPT_RETRY_TIMEOUT => 2,
                Memcached::OPT_SERVER_FAILURE_LIMIT => 1,
                Memcached::OPT_AUTO_EJECT_HOSTS => TRUE,

            ],
            'servers' => array_map(function($s) {
                $parts = explode(":", $s);
                return [
                    'host' => $parts[0],
                    'port' => $parts[1],
                    'weight' => 100,
                ];
              }, explode(",", env('MEMCACHIER_SERVERS', 'localhost:11211')))
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Key Prefix
    |--------------------------------------------------------------------------
    |
    | When utilizing a RAM based store such as APC or Memcached, there might
    | be other applications utilizing the same cache. So, we'll specify a
    | value to get prefixed to all our keys so we can avoid collisions.
    |
    */

    'prefix' => env(
        'CACHE_PREFIX',
        str_slug(env('APP_NAME', 'laravel'), '_').'_cache'
    ),

];
