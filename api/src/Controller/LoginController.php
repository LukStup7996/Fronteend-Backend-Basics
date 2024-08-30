<?php

namespace Fhtechnikum\Uebung34\Controller;

use Fhtechnikum\Uebung34\DTOs\StateDTO;
use Fhtechnikum\Uebung34\Gateways\UserReadDBGateway;
use Fhtechnikum\Uebung34\Views\JsonView;

class LoginController
{
    private $jsonView;

    public function __construct()
    {
        $this->jsonView = new JsonView();
    }
    public function route(){
        $action = filter_input(INPUT_GET,"action", FILTER_SANITIZE_STRING);
        switch (strtolower($action)){
            case 'login':
                $emailInput = filter_input(INPUT_GET, "username", FILTER_SANITIZE_EMAIL);
                $passwordInput = filter_input(INPUT_GET, "password", FILTER_SANITIZE_STRING);
                if($emailInput && $passwordInput){
                    $state = $this->validateUserLogin($emailInput, $passwordInput);
                    $this->returnState($state);
                }
                break;
            case 'logout':
                $state = $this->disconnectUser();
                $this->returnState($state);
                break;
            default:
                $this->error("Unknown Action");
        }
    }

    private function validateUserLogin($emailInput, $passwordInput){
        $userlogin = new UserReadDBGateway(DBHost, DBName, DBUsername, DBPassword);
        $dbUser = $userlogin->getUserByEmail($emailInput);
        if(password_verify($passwordInput, $dbUser->password)){
            $_SESSION['user'] = serialize($dbUser);
            return "OK";
        } else {
            return "ERROR";
        }
    }

    private function returnState($state){
        $stateDTO = new StateDTO();
        $stateDTO->state = $state;
        $this->jsonView->display($stateDTO);
    }

    private function disconnectUser(){
        if($_SESSION['user']){
            session_destroy();
            return "OK";
        } else{
            return "ERROR";
        }
    }

    private function error($errorMessage)
    {
        print ($errorMessage);
    }
}