<?php
/**
 * Author: Fernando Luna
 * Date: 4/6/2023
 * File: home_controller.class.php
 * Description:
 */

//created a class that will display content on the homepage
class HomeController {
    public function index(){
        $view = new HomeIndex();
        $view->display();
        
    }
}