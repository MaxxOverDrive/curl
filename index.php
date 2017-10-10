<?php
 use \Psr\Http\Message\ServerRequestInterface as Request;
 use \Psr\Http\Message\ResponseInterface as Response;
 use Slim\Views\PhpRenderer;

 require 'vendor/autoload.php';

include("simple_html_dom.php");

 $app = new \Slim\App();
 $container = $app->getContainer();
 $container['renderer'] = new PhpRenderer("./templates");

 $app->get('/', function ($request, $response, $args) {
     return $this->renderer->render($response, "/home.php", $args);
 });

 $app->post('/getLittleGiant', function($request, $response, $args){
    $var = new littleGiantWebscraper;
    $var->spill911();

 });

 $app->run();

class littleGiantWebscraper {

    function bizchair() {
        
        set_time_limit(0);

        $html = new simple_html_dom();

        $html->load_file("https://www.bizchair.com/search?q=Little-Giant");

        $query = $html->find("div.product-name-price-container");
        echo '<table style="border: 1px solid black; text-align: center;"><tr><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Product Name</td><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Model Number</td><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Price</td></tr>';
        foreach($query as $key => $result) {

            $itemName = $key->find("div.product-name a.name-link", 0)->plaintext;

            $modelNumber = $key->find("div.product-id span", 0)->plaintext;

            $price = $key->find("div.product-pricing span.product-sales-price", 0)->plaintext;

            echo '<tr><td style="border: 1px solid black;">' . $result . '</td>';

        }
        echo '</table>';
    }

    function hayneedle() {
        
        set_time_limit(0);

        $html = new simple_html_dom();

        $html->load_file("https://www.hayneedle.com/brands/little-giant/list");

        $query = $html->find(".lg-display-price-container div");

        echo '<table style="border: 1px solid black; text-align: center;"><tr><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Model Number</td><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Price</td></tr>';
        foreach($query as $key => $result) {
            echo '<tr><td style="border: 1px solid black;">' . $result . '</td></tr>';
        }
        echo '</table>';
    }

    function spill911() {

        set_time_limit(0);

        $html = new simple_html_dom();

        $html->load_file("https://www.spill911.com/mm5/merchant.mvc?Screen=SRCH2&Store_Code=spill911&search=little+giant&searchoffset=" . $i);

        $query = $html->find("div.ctgy-layout  p");
        echo '<table style="border: 1px solid black; text-align: center;"><tr><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Model Number</td><td style="border: 1px solid black; font-size: 110%; font-weight: 800;">Price</td></tr>';
        foreach($query as $key => $result) {
                echo '<tr><td style="border: 1px solid black;">' . $result . '</td></tr>';    
        }
        echo '</table>';
    }

    function industrialsafety() {
        set_time_limit(0);
        for($pages = 1; $pages <= 13; $pages++){
            $html = new simple_html_dom();

            $html->load_file("https://industrialsafety.com/catalogsearch/result/index/?p=" . $pages . "&product_list_limit=80&product_list_order=name&q=vestil");
            sleep(3);
            $query = $html->find("div.products-grid .grid-product-type li");

            foreach ($query as $product) {

                foreach ($product->find(".product-item-link") as $sku) {
                    $mySku = trim($sku->plaintext);
                    $skuArray = explode(" ", $mySku);
                    echo $skuArray[1];
                    echo "<br />";
                }

                foreach($product->find(".price-wrapper .price") as $price){
                    echo $price;
                }
            }
        }

    }

    function toolfetch(){
        for($j = 1; $j <= 142; $j++){
            //step1
            set_time_limit(0);
            $cSession = curl_init();
            //step2
            curl_setopt($cSession,CURLOPT_URL,"http://www.toolfetch.com/by-brand/vestil/l/brand:vestil.html?limit=48&p=" . $j);
            curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
            curl_setopt($cSession,CURLOPT_HEADER, false);
            //step3
            $result=curl_exec($cSession);
            //step4
            curl_close($cSession);
            //step5
            $html = new simple_html_dom();
            $mywebsite = $html->load($result);

            $array = $mywebsite->find("ul.products-grid li a.product-image");

            foreach ($array as $key) {

                $mysession = curl_init();
                //step2
                curl_setopt($mysession, CURLOPT_URL, $key->href);
                curl_setopt($mysession, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($mysession, CURLOPT_HEADER, false);
                //step3
                $myresult=curl_exec($mysession);
                //step4
                curl_close($mysession);

                $myhtml = new simple_html_dom();
                $thiswebsite = $html->load($myresult);

                $informationforgivenpage = $thiswebsite->find(".add-to-box span.price");
                $information = preg_replace("/[(),$]/", "", $informationforgivenpage);

                $productid = $thiswebsite->find("p.product-ids");
                $modelNumber = preg_replace("/Part# VES-/", "", $productid);

                foreach ($modelNumber as $productinformation) {
                    echo $productinformation;
                }

                foreach ($information as $price) {
                    echo $price;
                }

            }
        }
    }

    function opentip(){

        for($i = 1; $i <= 74; $i++){

            set_time_limit(0);

            $html = new simple_html_dom();
            $html->load_file("https://www.opentip.com/search.php?keywords=vestil&limit=100&page=" . $i);

            $card = $html->find(".item-detail");
            sleep(3);
            foreach ($card as $key) {

                $sku = $key->find(".products_sku span");

                $price = $key->find(".products_price");

                foreach ($price as $num) {
                    echo $num;
                }

                foreach ($sku as $model) {
                    echo $model;
                    echo "<br />";
                }

            }
        }

    }

}
