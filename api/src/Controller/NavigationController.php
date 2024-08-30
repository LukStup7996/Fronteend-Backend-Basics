<?php

namespace Fhtechnikum\Uebung34\Controller;

class NavigationController
{
    private $listController;
    private $cartController;

    private $loginController;
    private $orderController;
    public function __construct()
    {
        $this->listController = new ProductsListController();
        $this->cartController = new ArticleCartController();
        $this->loginController = new LoginController();
        $this->orderController = new OrderController();
    }

    public function route(){
        $action = filter_input(INPUT_GET,"action",FILTER_SANITIZE_STRING);
        switch(strtolower($action)){
            case 'listproductsbytypeid':
            case 'listtypes':
                if($_SESSION['user']) {
                    $this->navigateTypesAndProducts();
                } else{
                    $this->error("user is not logged in");
                }
                break;
            case 'removearticle':
            case 'listcart':
            case 'addarticle':
                if($_SESSION['user']) {
                    $this->navigateArticleCart();
                } else{
                    $this->error("user is not logged in");
                }
                break;
            case 'login':
            case 'logout':
                $this->navigateLogin();
                break;
            case 'placeorder':
            case 'listorderhistory':
                $this->navigateOrder();
                break;
            default:
                $this->error("Unknown Action");
        }
    }

    private function navigateTypesAndProducts(){
        $this->listController->route();
    }

    private function navigateArticleCart(){
        $this->cartController->route();
    }

    private function navigateLogin(){
        $this->loginController->route();
    }

    private function navigateOrder(){
        $this->orderController->route();
    }
    private function error($errorMessage)
    {
        print ($errorMessage);
    }
}