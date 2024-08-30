<?php

namespace Fhtechnikum\Uebung34\Gateways;

use PDO;
class UserReadDBGateway
{
    private $pdo;

    public function __construct(
        $host,
        $dbname,
        $user,
        $password
    )
    {
        $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
    }

    public function getUserByEmail($email){
        $sql = "SELECT firstname, lastname, email, user_id, password FROM shopusers where email = :email limit 1";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':email', $email);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_OBJ);

        return $user;
    }

}