<?php

namespace Fhtechnikum\Uebung34\Controller;

use Fhtechnikum\Uebung34\DTOs\StateDTO;
use Fhtechnikum\Uebung34\Gateways\ArticleCartGateway;
use Fhtechnikum\Uebung34\Views\JsonView;
use mysql_xdevapi\Exception;

class ArticleCartController
{
    private $jsonView;
    private $cart;

    public function __construct()
    {
        $this->jsonView = new JsonView();
        $this->cart = new ArticleCartGateway();
    }

    public function route(){
        $action = filter_input(INPUT_GET,"action", FILTER_SANITIZE_STRING);
        switch (strtolower($action)){
            case 'addarticle':
                $addProductById = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_NUMBER_INT);
                if($addProductById){
                    $this->handlingAddFunction($addProductById);
                }
                break;
            case 'removearticle':
                $removeProductById = filter_input(INPUT_GET, "articleId", FILTER_SANITIZE_NUMBER_INT);
                if($removeProductById){
                    $this->handlingRemoveFunction($removeProductById);
                }
                break;
            case 'listcart':
                $this->cart->displayCartContent();
                break;
            default:
                $this->error("Unknown Action");
        }
    }
    private function error($errorMessage)
    {
        print ($errorMessage);
    }

    function handlingAddFunction($addProductById){
        $state = "ERROR";
        try{
            $this->cart->addArticleToCart($addProductById,1);
            $state = "OK";
        }catch (Exception $error){
            $this->error($error->getMessage());
        } finally {
            $stateDTO = new StateDTO();
            $stateDTO->state = $state;
            $this->jsonView->display($stateDTO);
        }
    }

    function handlingRemoveFunction($removeProductById){
        $state = "ERROR";
        try {
            $this->cart->removeArticleFromCart($removeProductById, 1);
            $state = "OK";
        }catch (Exception $error){
            $this->error($error->getMessage());
        } finally {
            $stateDTO = new StateDTO();
            $stateDTO->state = $state;
            $this->jsonView->display($stateDTO);
        }

    }
}