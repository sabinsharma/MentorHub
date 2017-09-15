<?php

class ExchangeController
{
    public function index(){
        require_once 'Views/Exchange/ExchangeView.php';
    }
    public function create(){
        require_once 'Views/Exchange/ExchangeCreate.php';
    }
    public function view(){
        require_once 'Views/Exchange/ExchangeDetail.php';
    }
}