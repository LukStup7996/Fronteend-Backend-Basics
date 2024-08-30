<?php

namespace Fhtechnikum\Uebung34\Controller;
use Fhtechnikum\Uebung34\DTOs\OrderDTO;
use Fhtechnikum\Uebung34\Gateways\CartReadFromDBGateway;
use Fhtechnikum\Uebung34\Gateways\ProductsReadDBGateway;
use Fhtechnikum\Uebung34\Gateways\PushCartIntoDBGateway;
use Fhtechnikum\Uebung34\Views\JsonView;
use Fhtechnikum\Uebung34\DTOs\StateDTO;

class OrderController
{
    private $jsonView;
    function __construct(){
        $this->jsonView=  new jsonView();
    }
    public function route(){
        $action = filter_input(INPUT_GET,"action", FILTER_SANITIZE_STRING);
        switch (strtolower($action)){
            case 'placeorder':
                $state = $this->initiateOrderPlacement();
                $this->returnState($state);
                break;
            case 'listorderhistory':
                $data = $this->displayOrderHistory();
                $this->jsonView->display($data);
                break;
            default:
                $this->error("Unknown Action");
        }
    }

    private function initiateOrderPlacement(){
        $placeOrder = new PushCartIntoDBGateway(DBHost, DBName, DBUsername, DBPassword);
        $dbUpload = $placeOrder->pushCartIntoOrderHistory();

        foreach (array_keys($_SESSION['cart']) as $product_id){
            $productReadDBGateway = new ProductsReadDBGateway(DBHost, DBName, DBUsername, DBPassword);
            $product = $productReadDBGateway->getProductsById($product_id);
            $quantity = $_SESSION['cart'][$product_id];
            $placeOrder->pushOrderIntoDB($product->id, $dbUpload, $quantity, $product->price * $quantity);
        }
        if($placeOrder){
            unset($_SESSION['cart']);
            return "OK";
        }else{
            return "ERROR";
        }
    }

    private function displayOrderHistory(){
        $cartReadFromDBGateway = new CartReadFromDBGateway(DBHost, DBName, DBUsername, DBPassword);
        $order = $cartReadFromDBGateway->getOrderHistory();
        $orderhistory = array();
        foreach ($order as $item){
            $orderDTO = OrderDTO::map($item->order_date, $item->total_price);
            array_push($orderhistory, $orderDTO);
        }
        return $orderhistory;
    }

    private function returnState($state){
        $stateDTO = new StateDTO();
        $stateDTO->state = $state;
        $this->jsonView->display($stateDTO);
    }
    private function error($errorMessage)
    {
        print ($errorMessage);
    }
}