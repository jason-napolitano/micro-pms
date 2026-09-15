<?php

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Collection;

// --------------------------------------------------
// if the function doesn't exist, let's create it!
if (! function_exists('user')) {
    /**
     * Shorthand for auth()->user()
     *
     * @return Authenticatable|null
     */
    function user(): ?Authenticatable
    {
        return auth()->user();
    }
}


// --------------------------------------------------
// if the function doesn't exist, let's create it!
if (! function_exists('http_action')) {
    function http_action($actionClass, $args): Collection
    {
        return (new $actionClass)($args);
    }
}
