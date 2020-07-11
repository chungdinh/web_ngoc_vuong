<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~8192);

@define ( '_lib' , '../libraries/');

include_once _lib."config.php";
include_once _lib."constant.php";;
include_once _lib."functions_giohang.php";
include_once _lib."functions.php";
include_once _lib."class.database.php";

$d = new database($config['database']);
if (isAjaxRequest()) {
	@$pid = $_POST['pid'];
	@(int)$soluong = $_POST['soluong'];
	@$size = $_POST['size'];
	@$mausac = $_POST['mausac'];
	if($_POST['soluong']>0){
		@$soluong = $_POST['soluong'];
	}else {
		@$soluong = 1;
	}
	$result_giohang = addtocart($pid,$soluong,$size,$mausac);
	$count = count($_SESSION['cart']);
	$result = array('result_giohang' => $result_giohang,'count' => $count);
	echo json_encode($result);
}
?>