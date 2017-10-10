<?php

require 'vendor/autoload.php';

include 'simple_html_dom.php';

$html = new simple_html_dom();   
$html->load($output); 
$items = $html->find('div.product-name-price-container',0)->children(1)->outertext; 
print_r($items);

?>