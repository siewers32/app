<?php
namespace App\Middleware;
use App\Models\UserModel;
use App\Http\Request;
use App\Http\Response;

class Auth
{
    private $db;
    private array $messages;

    public function __construct($c) {
        $this->db = $c->get('db');
    }

    public function __invoke(Request $request, Response $response) {
        if(array_key_exists('email', $request->getParams()) && array_key_exists('password', $request->getParams())) {
            $this->checkCredentials($request->getParam('email'), $request->getParam('password'));
        } else if(!isset($_SESSION['user'])) {
            echo "Forbidden";
            die();
        }
    }

    public function checkCredentials($email, $password) {
        if(!empty($email) && !empty($password)) {
            $um = new UserModel();
            if($user = $um->getByKeyValue($this->db,'email', $email)) {
                if($password ==  $user['password']) { // password_verify($password, $user['password'])
                    $_SESSION['user'] = $user;
                }
            }
        }
    }
}