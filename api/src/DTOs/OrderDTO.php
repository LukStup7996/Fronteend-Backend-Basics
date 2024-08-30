<?php

namespace Fhtechnikum\Uebung34\DTOs;

class OrderDTO
{
    public $orderDate;
    public $totalPrice;

    public static function map($date, $price) {

        $orderDTO = new OrderDTO();
        $orderDTO->orderDate = $date;
        $orderDTO->totalPrice = $price;

        return $orderDTO;
    }
}