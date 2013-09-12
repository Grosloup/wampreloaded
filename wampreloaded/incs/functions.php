<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nicolas
 * Date: 12/09/13
 * Time: 20:29
 */
function autoload($class)
{
    $classname = str_replace("\\", "/", $class) . ".php";
    include_once $classname;
}

spl_autoload_register("autoload");

function loadJsonConfigs($path = "")
{
    global $debug;

    $configs = [];

    if (file_exists($path)) {
        $content = file_get_contents($path);
        if ($content) {
            $configs = json_decode($content, true);
        }
    } elseif ($debug) {
        die(__FUNCTION__ . " error: wrong path to config file.");
    }

    return $configs;
}

function saveJsonConfigs($configs = [], $path = "")
{
    global $debug;

    if (!$path) {
        if ($debug) {
            die(__FUNCTION__ . " error: path to configs file is undefined.");
        } else {
            return false;
        }
    }

    $result = false;
    $encoded = json_encode($configs, JSON_FORCE_OBJECT);

    if ($encoded) {
        $result = file_put_contents($path, $encoded);
        if ($result === false && $debug) {
            die(__FUNCTION__ . " error: saving configs file.");
        }
    } elseif ($debug) {
        die(__FUNCTION__ . " error: encoding error.");
    }

    return $result;
}