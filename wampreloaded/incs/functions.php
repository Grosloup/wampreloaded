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

function getPageName()
{
    global $configs;
    global $request;
    $page = ($request->get("page")) ? $request->get("page") : $configs["defaultPageName"];
    if(!in_array($page, $configs["allowedPages"])){
        $page = "404";
    }
    return $page;
}

function getPageTitle($pageName = "")
{
    global $configs;
    if (!$pageName) {
        $pageName = getPageName();
    }
    if (isset($configs["pages"][$pageName]["title"])) {
        return $configs["pages"][$pageName]["title"];
    }
    return $pageName;
}

function _getPageTitle($pageName = "")
{
    echo getPageTitle($pageName);
}

function getView($pageName = "")
{
    global $configs;
    global $request;

    if (!$pageName) {
        $pageName = getPageName();
    }

    $view = $configs["viewsDir"] . DS . $pageName . DS . "main.php";
    if(!is_file($view)){
        $request->set("page", "404");
        $view = $configs["viewsDir"] . DS . "404.php";
    }

    ob_start();
    require_once $view;
    $content = ob_get_clean();
    return $content;
}

function _getView($pageName = "")
{
    echo getView($pageName);
}

function getHeader($pageName = "")
{
    global $configs;

    if (!$pageName) {
        $pageName = getPageName();
    }

    $view = $configs["viewsDir"] . DS . $pageName . DS . "header.php";
    if(!is_file($view)){
        $view = $configs["viewsDir"] . DS . "header.php";
    }

    ob_start();

    require_once $view;
    return ob_get_clean();
}

function getFooter($pageName = "")
{
    global $configs;

    if (!$pageName) {
        $pageName = getPageName();
    }

    $view = $configs["viewsDir"] . DS . $pageName . DS . "footer.php";
    if(!is_file($view)){
        $view = $configs["viewsDir"] . DS . "footer.php";
    }

    ob_start();
    require_once $view;
    return ob_get_clean();
}

function _getFooter($pageName = "")
{

    echo getFooter($pageName);
}

function _getHeader($pageName = "")
{
    echo getPageName($pageName);
}