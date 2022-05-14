<?php

namespace App\Controllers;
use App\Application\Container;

class Controller
{

    protected $db;
    protected $view;

    public function __construct(Container $c) {
        $this->db = $c->get('db');
        $this->view = $c->get('view');
    }
}