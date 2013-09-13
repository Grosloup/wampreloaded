<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Nicolas
 * Date: 12/09/13
 * Time: 20:44
 */

namespace Core;


class Request
{
    protected $query = [];
    protected $post = [];
    protected $request = [];
    protected $session = [];

    public function __construct($get = [], $post = [], $request = [], $session = [])
    {
        $this->query = $get;
        $this->post = $post;
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * @param array $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequest()
    {
        return $this->request;
    }

    public static function create()
    {
        /** @var \Core\Request $req */
        $req = new static($_GET, $_POST, [], $_SESSION);
        $req->setRequest($req->getAjax());

        return $req;
    }

    public function isPost()
    {
        return $this->getMethod() === "post";
    }

    public function isAjax()
    {
        return array_key_exists("HTTP_X_REQUESTED_WITH", $_SERVER) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest";
    }

    public function getAjax()
    {
        $datas = [];
        $method = $this->getMethod();
        $contentType = array_key_exists("HTTP_CONTENT_TYPE", $_SERVER) ? $_SERVER["HTTP_CONTENT_TYPE"] : array_key_exists("CONTENT_TYPE", $_SERVER) ? $_SERVER["CONTENT_TYPE"] : null;
        $isAppJson = (strpos($contentType, "application/json") !== false) ? true : false ;
        if(in_array($method, ["put","delete","post"]) && $isAppJson && $this->isAjax()){
            parse_str(file_get_contents("php://input"),$datas);
        }
        return $datas;
    }

    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->query)) {
            return $this->query[$key];
        }
        if (array_key_exists($key, $this->post)) {
            return $this->post[$key];
        }
        if (array_key_exists($key, $this->request)) {
            return $this->request[$key];
        }
        if (array_key_exists($key, $this->session)) {
            return $this->session[$key];
        }
        return $default;
    }

    /**
     * @param array $post
     * @return $this
     */
    public function setPost($post)
    {
        $this->post = $post;
        return $this;
    }

    /**
     * @return array
     */
    public function getPost()
    {
        return $this->post;
    }

    /**
     * @param array $query
     * @return $this
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param array $session
     * @return $this
     */
    public function setSession($session)
    {
        $this->session = $session;
        return $this;
    }

    /**
     * @return array
     */
    public function getSession()
    {
        return $this->session;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->query[$key] = $value;
        return $this;
    }

    public function getMethod()
    {
        return strtolower($_SERVER["REQUEST_METHOD"]);
    }
}