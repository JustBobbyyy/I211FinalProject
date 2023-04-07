<?php
/**
 * Author: Fernando Luna
 * Date: 4/6/2023
 * File: store_controller.class.php
 * Description:
 */
class StoreController{

    private $store_model;

    //default constructor
    public function __construct()
    {
        $this->store_model = StoreModel::getStoreModel();
    }
    
    public function index(){
        $products = $this->store_model->list_products();
        $view = new StoreView(); // change to storeIndex when you have a chance
        $view->display($products);
    }

}