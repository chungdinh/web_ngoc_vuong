<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE & ~8192);
@define ( '_lib' , '../libraries/');
@define ( '_source' , '../sources/');
include_once _lib."config.php";
include_once _lib."constant.php";;
include_once _lib."functions.php";
include_once _lib."functions_giohang.php";
include_once _lib."class.database.php";
include_once _lib."file_requick.php";
include_once _source."lang_$lang.php";
if(isAjaxRequest()){
	$d = new database($config['database']);
	$id = $_POST['id'];
	$size = $_POST['size'];
	$mausac = $_POST['mausac'];
	$result_giohang = remove_product($id,$size,$mausac);
	$count = count($_SESSION['cart']);
	$total = ($lang == 'vi') ? number_format(get_order_total(),0, ',', '.') . ' ₫' : round(get_order_total() / $row_setting['tigia'],2). ' $';
	echo json_encode(array('count' => $count,'total'=>$total,'all_item'=>count_cart()));
}
