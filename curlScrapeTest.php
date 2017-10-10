<?php

$j = 0;

for($i = 0; $i <= 47; $i++) {

	$url = 'https://www.spill911.com/mm5/merchant.mvc?Screen=SRCH2&Store_Code=spill911&search=little+giant&searchoffset=' . $j;

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	$result = curl_exec($ch);

	print_r($result);

	$j += 32;

	curl_close($ch);
}

?>