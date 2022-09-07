<?php
namespace App\Models;
use \PDO;

class UserModel extends Model
{
    public function __construct() {
        $this->table = "user";
        $this->fields= [
            'email',
            'password'
        ];
        $this->pk = 'user_id';
    }

    public function getByEmailPassword(PDO $connection, $email, $password) {
        $query = "select * from ".$this->table." where email = :email and password = :password";
        $stmt = $connection->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}