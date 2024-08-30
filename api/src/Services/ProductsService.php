<?php

namespace Fhtechnikum\Uebung34\Services;

use Fhtechnikum\Uebung34\Gateways\ProductsReadDBGateway;

class ProductsService
{
    private $productsReadGateway;

    public function __construct()
    {
        $this->productsReadGateway= new ProductsReadDBGateway(DBHost,
            DBName,
            DBUsername,
            DBPassword);
    }


    public function getAllProductTypes()
    {
        $productModelList = $this->productsReadGateway->getAllProductTypes();
        return $productModelList;
    }

    public function getProductsByTypeId($productTypeId)
    {
        $productList = $this->productsReadGateway->getProductsByTypeId($productTypeId);
        return $productList;
    }

    public function getProductTypeName($productTypeId)
    {
        $productTypeName = $this->productsReadGateway->getProductTypeName($productTypeId);
        return $productTypeName;
    }

    public function getProductsById($productId){
        $productModel = $this->productsReadGateway->getProductsById($productId);
        return$productModel;
    }
}