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

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getStoreModel method must be called.
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

//static method to ensure there is just one StoreModel instance
    public static function getStoreModel()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new StoreModel();
        }
        return self::$_instance;
    }


    public function list_products()
    {
        /* construct the sql SELECT statement in this format
         * SELECT ...
         * FROM ...
         * WHERE ...
         */

        $sql = "SELECT * FROM " . $this->tblProducts . "," . $this->tblProducts_Category .
            " WHERE " . $this->tblProducts . ".prices=" . $this->tblProducts_Category . ".prices";

        try {


            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false.
            if (!$query)
                throw new DatabaseExecutionException(
                    "Error encountered when executing the SQL statement.");


            //if the query succeeded, but no movie was found.
            if ($query->num_rows == 0)
                return 0;

            //handle the result
            //create an array to store all returned movies
            $products = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $products = new Movie(stripslashes($obj->product_size), stripslashes($obj->color), stripslashes($obj->brand), stripslashes($obj->product_category), stripslashes($obj->price), stripslashes($obj->image));

                //set the id for the store
                $products->setId($obj->id);

                //add the store into the array
                $products[] = $products;
            }
            return $products;
        } catch (DatabaseExecutionException $e) {
            $view = new StoreError();
            $view->display($e->getMessage());
        } catch (Exception $e) {
            $view = new StoreError();
            $view->display($e->getMessage());
        }
    }
 }


