<?php
/**
 * Author: DJ Merrell
 * Date: 4/5/23
 * File: database.class.php
 * Description:
 */


/* Author: Louie Zhu
 * Date: 10/20/2021
 * Name: database.class.php
 * Description: the Database class sets the database details.
 */

class Database
{

    //define database parameters
    private $param = array(
        'host' => 'localhost',
        'login' => 'phpuser',
        'password' => 'phpuser',
        'database' => 'finalproject_db',
        'tblProductsCategories' => 'products_categorie',
        'tblProducts' => 'products',
        'tblRoles' => 'roles',
        'tblUsers' => 'users',
        'tblUserProducts' => 'userProduct'
    );
    //define the database connection object
    private $objDBConnection = NULL;
    static private $_instance = NULL;

    //constructor
    private function __construct()
    {

        $this->objDBConnection = @new mysqli(
            $this->param['host'],
            $this->param['login'],
            $this->param['password'],
            $this->param['database']
        );
        if (mysqli_connect_errno() != 0) {
            exit("Connecting to database failed: " . mysqli_connect_error());
        }
    }

    //static method to ensure there is just one Database instance
    static public function getDatabase()
    {
        if (self::$_instance == NULL) {
            self::$_instance = new Database();
        }
        return self::$_instance;
    }

    //this function returns the database connection object
    public function getConnection()
    {
        return $this->objDBConnection;
    }

    // get the storeModel 
    public function getStoreTable(){
        return $this->param['tblProducts'];
        
    }
}