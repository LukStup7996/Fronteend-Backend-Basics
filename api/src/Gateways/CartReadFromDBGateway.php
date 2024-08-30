<?php

namespace Fhtechnikum\Uebung34\Gateways;
use PDO;
class CartReadFromDBGateway
{
    private $pdo;
    function __construct(
        $host,
        $dbname,
        $user,
        $password
    )
    {
        $this->pdo = new PDO('mysql:host='.$host.';dbname='.$dbname, $user, $password);
    }

    public function getOrderHistory(){
        $user = unserialize($_SESSION['user']);
        $sql = "SELECT oh.order_id, oh.order_date as order_date, sum(poh.price) as total_price FROM orderhistory oh 
            INNER JOIN products_orderhistory poh 
            ON oh.order_id = poh.order_id
            WHERE user_id = :user_id
            group by order_id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':user_id', $user->user_id);
        $statement->execute();
        $orderhistory = $statement->fetchAll(PDO::FETCH_CLASS);
        return $orderhistory;
    }
}