<?php
namespace App\Controllers;
use App\Application\Container;
use App\Http\Request;
use App\Http\Response;
use App\Models\UserModel;


class HomeController extends Controller
{
    public function __construct(Container $c)
    {
        parent::__construct($c);

    }

    public function index(Request $request, Response $response, $args) {
        $this->view->render($response, 'home.phtml');
    }

    public function login(Request $request, Response $response, $args) {
        $this->view->render($response, 'login.phtml');
    }

//    public function afterlogin(Request $request, Response $response, $args) {
//        header('Location: /');
//    }


    public function logout(Request $request, Response $response, $args) {
        $_SESSION = [];
        session_destroy();
        $this->view->render($response, 'login.phtml');
    }
}