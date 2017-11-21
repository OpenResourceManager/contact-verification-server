<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/23/17
 * Time: 8:53 PM
 */

/**
 * @param string $path
 * @return mixed|string
 */
function fixPath($path = '')
{
    $path = str_replace('\\', '/', trim($path));
    return (substr($path, -1) != '/') ? $path .= '/' : $path;
}