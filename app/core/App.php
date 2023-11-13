<?php
class App
{
    protected $controller = "Home";
    protected $method = "index";
    protected $params = [];
    protected $route_path = "../app/controllers/";

    public function __construct()
    {
        $url = $this->parseURL();
        if (!is_null($url)) {
            if (file_exists($this->route_path . ucfirst($url[0]) . ".php")) {
                $this->controller = ucfirst($url[0]);
                unset($url[0]);
            } elseif ($url[0] === "admin") {
                $this->route_path = "../app/controllers/admin/";
                if (array_key_exists(1, $url)) {
                    if (file_exists($this->route_path . ucfirst($url[1]) . ".php")) {
                        $this->controller = ucfirst($url[1]);
                        unset($url[0], $url[1]);
                    } else $this->controller = "Auth";
                } else $this->controller = "Auth";
            }
        }

        require_once $this->route_path . $this->controller . ".php";
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        } elseif (isset($url[2])) {
            if (method_exists($this->controller, $url[2])) {
                $this->method = $url[2];
                unset($url[2]);
            }
        }

        if (!empty($url)) $this->params = array_values($url);

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_GET["url"])) {
            $url = rtrim($_GET["url"], "/");
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode("/", $url);
            return $url;
        }
    }
}
