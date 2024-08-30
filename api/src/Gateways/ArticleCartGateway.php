<?php

namespace Fhtechnikum\Uebung34\Gateways;
use Fhtechnikum\Uebung34\DTOs\CartContentsDTO;
use Fhtechnikum\Uebung34\DTOs\CartDTO;
use Fhtechnikum\Uebung34\Services\ProductsService;
use Fhtechnikum\Uebung34\Views\JsonView;
class ArticleCartGateway
{
    private $jsonView;
    private $cart;

    public function __construct()
    {
        $this->jsonView = new JsonView();
        $this->cart = $_SESSION['cart'];
    }

    function addArticleToCart($articleId,$quantity){
        if(isset($_SESSION['cart'])&&is_array($_SESSION['cart'])){
           $this->trackQuantity($articleId,$quantity);
    }else{
            $_SESSION['cart'] = array($articleId => $quantity);
        }
    }

    function trackQuantity($articleId,$quantity){
        if(array_key_exists($articleId, $_SESSION['cart'])){
            $_SESSION['cart'][$articleId] += $quantity;
        }else{
            $_SESSION['cart'][$articleId]=$quantity;
        }
    }
    function removeArticleFromCart($findArticle, $remove){

        $_SESSION['cart'][$findArticle] -=$remove;
        if($_SESSION['cart'][$findArticle] <= 0) {
            unset($_SESSION['cart'][$findArticle]);
        }
    }

    function displayCartContent (){
        $cartDTO = new CartDTO();
        $productService = new ProductsService();
        if(isset($_SESSION['cart'])){
            foreach (array_keys($_SESSION['cart']) as $articleId){
                $cartArticle = $productService->getProductsById($articleId);
                $dto = CartContentsDTO::map($cartArticle);
                array_push($cartDTO->cart, $dto);
            }
        }
        $this->jsonView->display($cartDTO);
    }
}