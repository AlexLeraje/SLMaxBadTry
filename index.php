<?php

spl_autoload_register(
/**
 * @throws Exception
 */
function ($class) {
    $path = str_replace('\\', '/', $class.'.php');
    if(file_exists(__DIR__ . "/" . $path))
        require_once($path);
    else
        throw new Exception('Class ' . $class .' not found!');
});


new Test();
