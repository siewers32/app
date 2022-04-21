<?php

class Auth
{
    private array $allowed_users;

    public function __construct() {
        $this->allowed_users = [];
    }

    public function addUsers($username, $password) {
        $this->allowed_users[$username] =  $password;
    }

    public function checkPasswordForUsersname($username, $password) {
        if($this->allowed_users[$username] == $password) {
            return true;
        } else {
            return false;
        }
    }

    public function handleRequest(Request $request, Response $response) {
        if($this->checkPasswordForUsersname(
            $request->getParam('login'),
            $request->getParam('password')
        )) {
            $response->append("User authenticated succesfully");
        } else {
            header('Location: index.php');
        }
    }
}