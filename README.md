# MemCachier and Laravel on Heroku tutorial

This is an example Laravel 5.6 task list app that uses the
[MemCachier add-on](https://addons.heroku.com/memcachier) in
[Heroku](http://www.heroku.com/). A running version of this app can be
found [here](http://memcachier-examples-laravel.herokuapp.com).

Detailed instructions for developing this app are available
[here](https://devcenter.heroku.com/articles/laravel-memcache).

## Deploy to Heroku

You can deploy this app yourself to Heroku to play with.

[![Deploy](https://www.herokucdn.com/deploy/button.png)](https://heroku.com/deploy)

## Running Locally

Run the following commands to get started running this app locally:

```sh
$ git clone https://github.com/memcachier/examples-laravel.git
$ cd examples-laravel
$ composer install
$ touch database/database.sqlite
$ php artisan migrate --force
$ echo "APP_KEY=`php artisan key:generate --show`" > .env
$ memcached &  # run a local memcached server instance
$ php artisan serve
```

Then visit `http://localhost:8000` to play with the app.

Note: instead of running a local `memcached` server you can also create a
[MemCachier](https://www.memcachier.com/) cache and add the `MEMCACHIER_*`
environment variables to `.env`.

## Deploying to Heroku

Run the following commands to deploy the app to Heroku:

```sh
$ git clone https://github.com/memcachier/examples-laravel.git
$ cd examples-laravel
$ heroku create
Creating app... done, ⬢ rocky-chamber-17110
https://rocky-chamber-17110.herokuapp.com/ | https://git.heroku.com/rocky-chamber-17110.git
$ heroku addons:create memcachier:dev
$ heroku addons:create heroku-postgresql:hobby-dev
$ heroku config:set APP_KEY=$(php artisan key:generate --show)
$ heroku config:set DB_CONNECTION=pgsql
$ heroku config:set LOG_CHANNEL=errorlog
$ heroku config:set CACHE_DRIVER=memcached
$ heroku config:set SESSION_DRIVER=memcached
$ git push heroku master
$ heroku run php artisan migrate --force
$ heroku open
```

## Configuring MemCachier

To configure Laravel to use php-memcached with MemCachier. The `stores` in your
`cache.py` file should contain the following memcached configuration:

```php
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
]
```

## Get involved!

We are happy to receive bug reports, fixes, documentation enhancements,
and other improvements.

Please report bugs via the
[github issue tracker](http://github.com/memcachier/examples-laravel/issues).

Master [git repository](http://github.com/memcachier/examples-laravel):

* `git clone git://github.com/memcachier/examples-laravel.git`

## Licensing

This example is open-sourced software licensed under the
[MIT license](https://opensource.org/licenses/MIT).
