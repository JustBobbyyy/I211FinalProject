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
    private $tblProducts;
    private $tblProducts_Category;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getMovieModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblProducts = $this->db->getProductsTable();
        $this->tblProducts_Category = $this->db->getProducts_CategoryTable();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }

        //initialize product prices
        if (!isset($_SESSION['store_prices'])) {
            $prices = $this->get_store_prices();
            $_SESSION['store_prices'] = $prices;
        }
}

//static method to ensure there is just one MovieModel instance
    public static function getStoreModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new StoreModel();
        }
        return self::$_instance;
    }
 }


