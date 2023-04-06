<?php
/**
 * Author: Fernando Luna
 * Date: 4/6/2023
 * File: home_controller.class.php
 * Description:
 */

class HomeController {
    public function index(){
        $view = new HomeIndex();
        $view->display();
        
    }
}