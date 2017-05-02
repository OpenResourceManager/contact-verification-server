<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/23/17
 * Time: 8:53 PM
 */

use OpenResourceManager\ORM;

/**
 * Get an ORM connection
 *
 * Reads environment vars and returns an ORM connection.
 *
 * @return ORM
 */
function getORMConnection()
{
    $orm = new ORM(env('ORM_API_SECRET', ''), env('ORM_HOST', 'localhost'), env('ORM_VERSION', 1), env('ORM_PORT', 80), env('ORM_USE_HTTPS', false));
    return $orm;
}

/**
 * @param string $path
 * @return mixed|string
 */
function fixPath($path = '')
{
    $path = str_replace('\\', '/', trim($path));
    return (substr($path, -1) != '/') ? $path .= '/' : $path;
}