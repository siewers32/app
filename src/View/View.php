<?php

namespace App\View;
use App\Http\Response;
use App\Http\Request;

class View
{
    private string $layout;
    private string $page_dir;
    private array $data;

    public function __construct() {
        $this->page_dir = __DIR__."/../".$_ENV['VIEW_PATH']."/";
        $this->layout = $this->page_dir."/".$_ENV['VIEW_TPL'];
    }

    function setLayout($page) {
        $this->layout =  $this->page_dir."/".$page;
    }

    function add($key, $value) {
        $this->data[$key] = $value;
    }

    function render(Response $response, $page_name) {
        $render = [];
        $layout = file_get_contents($this->layout);
        include($this->page_dir."/".$page_name);
        $response->append(strtr($layout, $render));
    }
}