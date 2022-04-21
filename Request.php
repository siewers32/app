<?php

class Request
{
    private array $params;

    public function __construct() {
        $this->params = [];
        $this->buildRequest();
    }

    private function buildRequest() {
        if(isset($_POST)) {
            foreach($_POST  as $key => $value) {
                $this->addParam($key, $value);
            }
        }
    }

    private function addParam($key, $value) {
        $this->params[$key] = $value;
    }

    public function getParam($name) {
        return $this->params[$name];
    }

    public function getParams() {
        return $this->params;
    }
}
