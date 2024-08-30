<?php

namespace Fhtechnikum\Uebung34\DTOs;

class CartContentsDTO
{
    public $articleName;
    public $amount;
    public $price;
    public $articleId;
    public $total;
    public static function map($product){
        $article = new CartContentsDTO();
        $article->articleId = $product->id;
        $article->articleName = $product->name;
        $article->price = $product->price;
        $article->amount = $_SESSION['cart'][$product->id];
        $article->total = $product->price*$article->amount;

        return $article;
    }
}