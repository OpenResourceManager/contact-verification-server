<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/23/17
 * Time: 8:53 PM
 */

use OpenResourceManager\Laravel\Facade\ORM;

/**
 * Get an ORM connection
 *
 * Reads environment vars and returns an ORM connection.
 *
 * @return ORM
 */
function getORMConnection()
{
    return ORM::get();
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