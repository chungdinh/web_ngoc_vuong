<?php
session_start();
@define ( '_lib' , '../libraries/');
include_once _lib."config.php";
include_once _lib."constant.php";;
include_once _lib."functions.php";
include_once _lib."functions_giohang.php";
include_once _lib."class.database.php";
include_once _lib."file_requick.php";
if (isAjaxRequest() && isset($_POST['token']) && $_POST['token'] === $_SESSION['token']) {
	$q = $_POST['soluong'];
	$product = $_POST['id'];
	$size = $_POST['size'];
	$mausac = $_POST['mausac'];
	$max=count($_SESSION['cart']);
	for($i=0;$i<$max;$i++){
		$pid=$_SESSION['cart'][$i]['productid'];
		if($pid==$product && $size==$_SESSION['cart'][$i]['size'] && $mausac==$_SESSION['cart'][$i]['mausac'] ){
			if($q>0 && $q<=99){
				$_SESSION['cart'][$i]['qty']=$q;
			}
		}
	}
	$price_item = ($lang == 'vi') ? number_format(get_price($product)*$q,0, ',', '.')." đ" : round((get_price($product)*$q) / $row_setting['tigia'], 2). ' $';
	$full_item = ($lang == 'vi') ? number_format(get_order_total(),0, ',', '.')." đ" : round(get_order_total() / $row_setting['tigia'],2). ' $';
	echo json_encode(array('price_item' => $price_item ,'full_item' => $full_item,'count'=>count_cart()));
}
?>