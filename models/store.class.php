<?php
/**
 * Author: Bobby Ezenwelu
 * Date: 4/6/23
 * File: store.class.php
 * Description:
 */

class Store
{
    //private data members
    private $product_id, $product_size, $color, $brand, $product_cat, $price, $image;

    //the constructor
    public function __construct($product_size, $color, $brand, $product_cat, $price, $image)
    {
        $this->product_size = $product_size;
        $this->color = $color;
        $this->brand = $brand;
        $this->product_cat = $product_cat;
        $this->price = $price;
        $this->image = $image;
    }

    //get the product id
    public function getProduct_ID() {
        return $this->product_id;
    }

    //get the product size
    public function getProduct_size() {
        return $this->product_size;
    }

    //get the product color
    public function getColor() {
        return $this->color;
    }

    //get the product date
    public function getBrand() {
        return $this->brand;
    }

    //get the product category
    public function getProduct_cat() {
        return $this->product_cat;
    }

    //get the product price
    public function getPrice() {
        return $this->price;
    }

    // get the product image file
    public function getImage() {
        return $this->image;
    }

    //set product id
    public function setProduct_ID($product_id) {
        $this->product_id = $product_id;
    }




}