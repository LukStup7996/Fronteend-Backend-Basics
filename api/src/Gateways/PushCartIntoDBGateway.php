<?php

namespace Fhtechnikum\Uebung34\Gateways;
use PDO;

class PushCartIntoDBGateway
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

    public function pushCartIntoOrderHistory(){
        $sql = "INSERT INTO orderhistory (user_id) values (:user_id)";
        $statement = $this->pdo->prepare($sql);
        $user = unserialize($_SESSION['user']);
        $statement->bindParam(':user_id',$user->user_id);
        $statement->execute();
        return $this->pdo->lastInsertId();
    }

    public function pushOrderIntoDB($product_id, $order_id, $quantity, $price){
        $sql = "INSERT INTO products_orderhistory (product_id, order_id, quantity, price) values (:product_id, :order_id, :quantity, :price)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':product_id',$product_id);
        $statement->bindParam(':order_id',$order_id);
        $statement->bindParam(':quantity',$quantity);
        $statement->bindParam(':price',$price);
        $statement->execute();
    }
}