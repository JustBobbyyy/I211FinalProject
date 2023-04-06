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
    private $tblProductsCategory;

    //To use singleton pattern, this constructor is made private. To get an instance of the class, the getStoreModel method must be called.
    private function __construct()
    {
        $this->db = Database::getDatabase();
        $this->dbConnection = $this->db->getConnection();
        $this->tblProducts = $this->db->getProductsTable();
        $this->tblProductsCategory = $this->db->getProductsCategory();

        //Escapes special characters in a string for use in an SQL statement. This stops SQL inject in POST vars.
        foreach ($_POST as $key => $value) {
            $_POST[$key] = $this->dbConnection->real_escape_string($value);
        }
        
        foreach($_GET as $key => $value){
            $_GET[$key] = $this->dbConnection->real_escape_string($value);
            
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

        $sql = "SELECT * FROM " . $this->tblProducts . "," . $this->tblProductsCategory .
            " WHERE " . $this->tblProducts . ".product_cat=" . $this->tblProductsCategory . ".id";



        try {


            //execute the query
            $query = $this->dbConnection->query($sql);

            // if the query failed, return false.
            if (!$query)
                throw new DatabaseExecutionException(
                    "Error encountered when executing the SQL statement.");


            //if the query succeeded, but no product was found.
            if ($query->num_rows == 0)
                return 0;

            //handle the result
            //create an array to store all returned product
            $products = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $product = new Store(stripslashes($obj->product_size), stripslashes($obj->color), stripslashes($obj->brand), stripslashes($obj->category), stripslashes($obj->price), stripslashes($obj->image));

                //set the id for the product
                $product->setProduct_ID($obj->product_id);

                //add the store into the array
                $products[] = $product;
            }
            return $products;
        } catch (DatabaseExecutionException $e) {
           // $view = new StoreError();
            //$view->display($e->getMessage());
        } catch (Exception $e) {
            //$view = new StoreError();
            //$view->display($e->getMessage());
        }
    }

    public function view_products($product_id)
    {
        //the select ssql statement
        $sql = "SELECT * FROM " . $this->tblProducts . "," . $this->tblProducts_Category .
            " WHERE " . $this->tblMovie . ".rating=" . $this->tblMovieRating . ".rating_id" .
            " AND " . $this->tblMovie . ".id='$product_id'";

        try {


            //execute the query
            $query = $this->dbConnection->query($sql);

            if (!$query)
                throw new DatabaseExecutionException(
                    "Error encountered when executing the SQL statement.");

            if ($query && $query->num_rows > 0) {
                $obj = $query->fetch_object();

                //create a movie object
                $products = new Movie(stripslashes($obj->product_size), stripslashes($obj->color), stripslashes($obj->brand), stripslashes($obj->product_category), stripslashes($obj->price), stripslashes($obj->image));

                //set the id for the movie
                $products->setId($obj->product_id);

                return $products;
            }

            return false;
        } catch (DatabaseExecutionException $e) {
            $view = new StoreError();
            $view->display($e->getMessage());
        } catch (Exception $e) {
            $view = new MovieError();
            $view->display($e->getMessage());
        }
    }

    //search the database for movies that match words in titles. Return an array of movies if succeed; false otherwise.
    public function search_movie($terms)
    {
        $terms = explode(" ", $terms); //explode multiple terms into an array
        //select statement for AND serach
        $sql = "SELECT * FROM " . $this->tblProducts_Category . "," . $this->tblProducts_Category .
            " WHERE " . $this->tblProducts . ".rating=" . $this->tblProducts_Category . ".rating_id AND (1";

        foreach ($terms as $term) {
            $sql .= " AND title LIKE '%" . $term . "%'";
        }

        $sql .= ")";

        try {


            //execute the query
            $query = $this->dbConnection->query($sql);

            // the search failed, return false.
            if (!$query)
                throw new DatabaseExecutionException(
                    "Error encountered when executing the SQL statement.");


            //search succeeded, but no movie was found.
            if ($query->num_rows == 0)
                return 0;

            //search succeeded, and found at least 1 movie found.
            //create an array to store all the returned movies
            $movies = array();

            //loop through all rows in the returned recordsets
            while ($obj = $query->fetch_object()) {
                $products = new Movie(stripslashes($obj->product_size), stripslashes($obj->color), stripslashes($obj->brand), stripslashes($obj->product_category), stripslashes($obj->price), stripslashes($obj->image));

                //set the id for the movie
                $products->setId($obj->id);

                //add the movie into the array
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

    //get all movie ratings
    private function get_movie_category()
    {
        $sql = "SELECT * FROM " . $this->tblProducts_Category;

        //execute the query
        $query = $this->dbConnection->query($sql);

        if (!$query) {
            return false;
        }

        //loop through all rows
        $price = array();
        while ($obj = $query->fetch_object()) {
            $ratings[$obj->rating] = $obj->rating_id;
        }
        return $price;
    }
 }


