<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array
     */
    protected $proxies = '**';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var string
     */
    protected $headers = Request::HEADER_X_FORWARDED_AWS_ELB;
    // For Laravel 5.5
    // protected $headers = [
    //     Request::HEADER_FORWARDED    => null, // not set on AWS or Heroku
    //     Request::HEADER_CLIENT_IP    => 'X_FORWARDED_FOR',
    //     Request::HEADER_CLIENT_HOST  => null, // not set on AWS or Heroku
    //     Request::HEADER_CLIENT_PROTO => 'X_FORWARDED_PROTO',
    //     Request::HEADER_CLIENT_PORT  => 'X_FORWARDED_PORT',
    // ];
}
