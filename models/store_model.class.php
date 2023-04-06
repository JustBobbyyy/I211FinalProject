<?php
/**
 * Author: Bobby Ezenwelu
 * Date: 4/6/23
 * File: store_model.class.php
 * Description: the store model
 */

class StoreModel {
    //private data members
    private $db;
    private $dbConnection;
    static private $_instance = NULL;
    private $tblMovie;
    private $tblMovieRating;
}
