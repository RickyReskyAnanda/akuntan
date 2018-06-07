<?php

// function formatNumber($number, $currency = 'IDR'){
// 	if($currency == 'USD') {
// 		return number_format($number, 2, '.', ',');
// 	}
// 	return number_format($number, 0, '.', '.');
// }

function decConvId($id){
	return base64_decode(base64_decode($id));
}
function encConvId($id){
	return base64_encode(base64_encode(strval($id)));
}
function rupiah($number){
	return 'Rp.'.number_format($number);
}