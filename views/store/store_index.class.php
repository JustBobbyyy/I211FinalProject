<?php

/**
 * Author: Bobby Ezenwelu
 * Date: 4/6/23
 * File: store_index.class.php
 * Description:
 */
class StoreView extends IndexView {

    public function display($products) {
        //display page header
        parent::displayHeader("List All Products");

        ?>
        <div id="main-header"> Products in the Store</div>

        <div class="grid-container">
            <?php
            if ($products == 0) {
                echo "No product was found.<br><br><br><br><br>";
            } else {
                //display movies in a grid; six movies per row
                foreach ($products as $product) {
                    $id = $product->getProductId();
                    $product_size = $product->getProduct_size();
                    $color = $product->getColor();
                    $brand = $product->getBrand();
                    $product_cat = $product->getProduct_category();
                    $price = $product->getPrice();
                    $image = $product->getImage();
                    if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
                        $image = BASE_URL . "/" . $image;
                    }

                    echo "<div class='item'><p><a href='#'><img src='" . $image .
                        "'></a><span>$brand<br>Color $color<br>" . $product_size. "<br> $" . $price . "<br>". $product_cat .  "</span></p></div>";

                }
            }
            ?>
        </div>

        <?php
        //display page footer
        parent::displayFooter();

    } //end of display method
}

?>





















/*//this method displays the page header
static public function displayHeader($page_title) {
    */?><!--
    <!DOCTYPE html>
    <html>
    <head>
        <title>  /*echo $page_title */?> </title>
        <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>
        <link rel='shortcut icon' href='/*= BASE_URL */?>/www/img/favicon.ico' type='image/x-icon' />
        <link type='text/css' rel='stylesheet' href='/*= BASE_URL */?>/www/css/app_style.css' />
        <script>
            //create the JavaScript variable for the base url
            var base_url = "</*= BASE_URL */?>";
        </script>
    </head>
    <body>
    <div id="top"></div>
    <div id='wrapper'>
    <div id="banner">
        <a href="/*= BASE_URL */?>/index.php" style="text-decoration: none" title="Rare Relics">
            <div id="left">
                <img src='/*= BASE_URL */?>/www/img/logo.png' style="width: 180px; border: none" />
                <span style='color: #000; font-size: 36pt; font-weight: bold; vertical-align: top'>
                                    Vintage Store
                                </span>
                <div style='color: #000; font-size: 14pt; font-weight: bold'>An interactive application designed with MVC pattern</div>
            </div>
        </a>
        <div id="right">
            <img src="/*= BASE_URL */?>/www/img/kungfupanda.png" style="width: 400px; border: none" />
        </div>
    </div>

/*}//end of displayHeader function

    //this method displays the page footer
    public static function displayFooter() {
    */?>
    <br><br><br>
    <div id="push"></div>
    </div>
    <div id="footer"><br>&copy 2023 Rare Relics. All Rights Reserved.</div>
    <script type="text/javascript" src="/*= BASE_URL */?>/www/js/ajax_autosuggestion.js"></script>
    </body>
    </html>
    -->
<--! --> *} //end of displayFooter function*/